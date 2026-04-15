<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class AdminNotification extends Model
{
    use HasFactory;

    protected $table = 'admin_notifications';

    protected $fillable = [
        'slug',
        'user_id',
        'refrence_id',
        'message',
        'is_read',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'refrence_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Rows the back office should see: assigned to this user, broadcast (null),
     * or legacy rows stored with a non–back-office user (e.g. customer submitter).
     */
    public function scopeVisibleInAdminPanel(Builder $query): Builder
    {
        return $query->where(function (Builder $q) {
            $authId = auth()->id();

            $q->where('user_id', $authId)
                ->orWhereNull('user_id')
                ->orWhereHas('user', function (Builder $userQuery) {
                    $userQuery->whereHas('role', function (Builder $roleQuery) {
                        $roleQuery->whereNotIn('type', ['superadmin', 'admin', 'staff']);
                    });
                });
        });
    }

    public static function unreadCountForAdminPanel(): int
    {
        if (! Schema::hasTable((new static)->getTable()) || ! auth()->check()) {
            return 0;
        }

        return (int) static::query()
            ->visibleInAdminPanel()
            ->where('is_read', '0')
            ->count();
    }

    public static function latestForAdminPanel(int $limit = 8)
    {
        if (! Schema::hasTable((new static)->getTable()) || ! auth()->check()) {
            return collect();
        }

        return static::query()
            ->visibleInAdminPanel()
            ->latest()
            ->limit($limit)
            ->get();
    }
}
