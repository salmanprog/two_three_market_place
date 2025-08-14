<?php

namespace Modules\Attendance\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class EventBooking extends Model
{
    protected $fillable = ['event_id','user_id','no_of_ticket','tx_id','is_paid','purchase_date','status','created_by','updated_by'];

    public function scopeActive($query)
    {
        return $query->where('status',1);
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->created_by = Auth::id() ?? null;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id() ?? null;
        });
    }
}
