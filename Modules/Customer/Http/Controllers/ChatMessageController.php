<?php

namespace Modules\Customer\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\Customer\Entities\Chat;

class ChatMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'maintenance_mode']);
    }

    public function index()
    {
        $userId = auth()->id();

        if ($this->isBackOfficeAdminRole()) {
            [$conversations, $usersForNew] = $this->fullInboxPayload($userId);
        } else {
            [$conversations, $usersForNew] = $this->participantInboxPayload($userId);
        }

        return view('customer::chat.index', [
            'conversations' => $conversations,
            'usersForNew' => $usersForNew,
        ]);
    }

    /**
     * Customer profile: only threads the logged-in user participates in; new chats target staff/admin users.
     */
    public function customerIndex()
    {
        $userId = auth()->id();
        [$conversations, $usersForNew] = $this->participantInboxPayload($userId);

        return view('frontend.amazy.pages.profile.chat', [
            'conversations' => $conversations,
            'usersForNew' => $usersForNew,
        ]);
    }

    public function messages(Request $request)
    {
        $slug = (string) $request->query('slug', '');
        if ($slug === '') {
            return response()->json(['messages' => []]);
        }

        $userId = auth()->id();
        $allowed = Chat::where('slug', $slug)
            ->where(function ($q) use ($userId) {
                $q->where('senderId', $userId)->orWhere('receiverId', $userId);
            })
            ->exists();

        if (! $allowed) {
            return response()->json(['messages' => []]);
        }

        $messages = Chat::where('slug', $slug)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at')
            ->orderBy('id')
            ->get();

        $this->markThreadReadForReceiver($slug, $userId);

        return response()->json([
            'messages' => $messages->map(function (Chat $m) use ($userId) {
                $sender = $m->sender;

                return [
                    'id' => $m->id,
                    'message' => $m->message,
                    'created_at' => optional($m->created_at)->toIso8601String(),
                    'is_own' => (int) $m->senderId === $userId,
                    'sender_label' => $sender
                        ? trim(($sender->first_name ?? '').' '.($sender->last_name ?? '')) ?: $sender->email
                        : (string) $m->senderId,
                ];
            }),
        ]);
    }

    public function store(Request $request)
    {
        $userId = auth()->id();
        $slug = trim((string) $request->input('slug', ''));
        $message = trim((string) $request->input('message', ''));

        if ($message === '') {
            return response()->json(['errors' => ['message' => [__('common.message').' '.__('validation.required')]]], 422);
        }

        $threadExists = $slug !== '' && Chat::where('slug', $slug)->exists();

        if ($threadExists) {
            $receiverId = Chat::otherUserIdForSlug($slug, $userId);
            if (! $receiverId || $receiverId === $userId) {
                return response()->json(['errors' => ['slug' => [__('common.error')]]], 422);
            }
        } else {
            $validator = Validator::make($request->all(), [
                'receiver_id' => 'required|integer|exists:users,id|not_in:'.$userId.',1',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $receiverId = (int) $request->input('receiver_id');
            if ($slug === '') {
                $slug = (string) Str::uuid();
            }
        }

        $chat = Chat::create([
            'slug' => $slug,
            'senderId' => $userId,
            'receiverId' => $receiverId,
            'message' => $message,
            'is_read' => '0',
        ]);

        $chat->load(['sender', 'receiver']);
        $sender = $chat->sender;

        return response()->json([
            'slug' => $chat->slug,
            'chat' => [
                'id' => $chat->id,
                'message' => $chat->message,
                'created_at' => optional($chat->created_at)->toIso8601String(),
                'is_own' => true,
                'sender_label' => $sender
                    ? trim(($sender->first_name ?? '').' '.($sender->last_name ?? '')) ?: $sender->email
                    : (string) $chat->senderId,
            ],
        ]);
    }

    private function markThreadReadForReceiver(string $slug, int $receiverId): void
    {
        if (! Schema::hasColumn((new Chat)->getTable(), 'is_read')) {
            return;
        }

        Chat::where('slug', $slug)
            ->where('receiverId', $receiverId)
            ->where('is_read', '0')
            ->update(['is_read' => '1']);
    }

    private function isBackOfficeAdminRole(): bool
    {
        $type = auth()->user()->role->type ?? '';

        return in_array($type, ['superadmin', 'admin', 'staff'], true);
    }

    /**
     * @return array{0: Collection, 1: Collection<int, User>}
     */
    private function fullInboxPayload(int $viewerId): array
    {
        $latestIds = Chat::query()
            ->selectRaw('MAX(id) as id')
            ->groupBy('slug')
            ->pluck('id');

        $conversationRows = Chat::query()
            ->whereIn('id', $latestIds)
            ->with(['sender', 'receiver'])
            ->orderByDesc('created_at')
            ->get();

        $conversations = $this->mapConversationSummaries($conversationRows, $viewerId);

        $usersForNew = User::query()
            ->where('id', '!=', $viewerId)
            ->where('id', '!=', 1)
            ->orderBy('first_name')
            ->orderBy('email')
            ->limit(400)
            ->get(['id', 'first_name', 'last_name', 'email']);

        return [$conversations, $usersForNew];
    }

    /**
     * @return array{0: Collection, 1: Collection<int, User>}
     */
    private function participantInboxPayload(int $viewerId): array
    {
        $mySlugs = Chat::query()
            ->where(function ($q) use ($viewerId) {
                $q->where('senderId', $viewerId)->orWhere('receiverId', $viewerId);
            })
            ->distinct()
            ->pluck('slug');

        if ($mySlugs->isEmpty()) {
            $conversationRows = collect();
        } else {
            $latestIds = Chat::query()
                ->selectRaw('MAX(id) as id')
                ->whereIn('slug', $mySlugs)
                ->groupBy('slug')
                ->pluck('id');

            $conversationRows = Chat::query()
                ->whereIn('id', $latestIds)
                ->with(['sender', 'receiver'])
                ->orderByDesc('created_at')
                ->get();
        }

        $conversations = $this->mapConversationSummaries($conversationRows, $viewerId);

        $usersForNew = User::query()
            ->where('id', '!=', $viewerId)
            ->where('id', '!=', 1)
            ->whereHas('role', function ($q) {
                $q->whereIn('type', ['admin', 'superadmin', 'staff']);
            })
            ->orderBy('first_name')
            ->orderBy('email')
            ->limit(150)
            ->get(['id', 'first_name', 'last_name', 'email']);

        return [$conversations, $usersForNew];
    }

    /**
     * @param  \Illuminate\Support\Collection<int, Chat>  $conversationRows
     */
    private function mapConversationSummaries(Collection $conversationRows, int $viewerId): Collection
    {
        return $conversationRows->map(function (Chat $row) use ($viewerId) {
            $otherId = (int) $row->senderId === $viewerId
                ? (int) $row->receiverId
                : (int) $row->senderId;
            $other = User::query()->find($otherId);
            $name = $other
                ? trim(($other->first_name ?? '').' '.($other->last_name ?? '')) ?: $other->email
                : '#'.$otherId;

            return [
                'slug' => $row->slug,
                'preview' => Str::limit((string) ($row->message ?? ''), 72),
                'updated_at' => optional($row->created_at)->toIso8601String(),
                'other_name' => $name,
            ];
        })->values();
    }
}
