<?php

namespace Modules\Attendance\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\Attendance\Entities\EventBooking;

class Event extends Model
{
    protected $fillable = ['title','for_whom','location','description','from_date','to_date','image','price','total_ticket','sold_ticket','remaining_ticket','status','created_by','updated_by'];

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

    public static function scopeTotalEvents()
    {
        $auth_id = auth()->user()->id;
        return Event::query()->where('created_by', $auth_id)->get()->count();
    }

    public static function scopeTotalActiveEvents()
    {
        $auth_id = auth()->user()->id;
        return Event::query()->where('created_by', $auth_id)->where('to_date','>', date('Y-m-d'))->get()->count();
    }

    public static function scopeTotalExpireEvents()
    {
        $auth_id = auth()->user()->id;
        return Event::query()->where('created_by', $auth_id)->where('to_date','<', date('Y-m-d'))->get()->count();
    }
}
