<?php

namespace Modules\Customer\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chat';

    protected $fillable = [
        'slug',
        'senderId',
        'receiverId',
        'message',
        'is_read',
    ];

    protected $casts = [
        'senderId' => 'integer',
        'receiverId' => 'integer',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'senderId');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiverId');
    }

    /**
     * The other participant in a thread for the given user (admin or customer).
     */
    public static function unreadCountForUser(int $userId): int
    {
        if (! Schema::hasColumn((new static)->getTable(), 'is_read')) {
            return 0;
        }

        return (int) static::query()
            ->where('receiverId', $userId)
            ->where('is_read', '0')
            ->count();
    }

    public static function otherUserIdForSlug(string $slug, int $userId): ?int
    {
        $row = static::where('slug', $slug)
            ->where(function ($q) use ($userId) {
                $q->where('senderId', $userId)->orWhere('receiverId', $userId);
            })
            ->orderBy('id')
            ->first();

        if (!$row) {
            return null;
        }

        return (int) $row->senderId === $userId
            ? (int) $row->receiverId
            : (int) $row->senderId;
    }
}
