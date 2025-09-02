<?php

namespace Modules\Attendance\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\Attendance\Entities\Event;
use App\Models\User;
use Carbon\Carbon;

class EventBooking extends Model
{
    protected $fillable = ['event_id','user_id','no_of_ticket','tx_id','is_paid','purchase_date','status','created_by','updated_by'];

    public function scopeActive($query)
    {
        return $query->where('status',1);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
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

    public function scopeEventBookingInfo($query, $type, $state)
    {
        $year = Carbon::now()->year;
        if ($type == "today") {
            $query->whereBetween('created_at', [Carbon::now()->format('y-m-d')." 00:00:00", Carbon::now()->format('y-m-d')." 23:59:59"]);
        }
        elseif ($type == "week") {
            $query->whereBetween('created_at', [Carbon::now()->subDays(7)->format('y-m-d')." 00:00:00", Carbon::now()->format('y-m-d')." 23:59:59"]);
        }
        elseif ($type == "month") {
            $month = Carbon::now()->month;
            $date_1 = Carbon::create($year, $month)->startOfMonth()->format('Y-m-d')." 00:00:00";
            $query->whereBetween('created_at', [$date_1, Carbon::now()->format('y-m-d')." 23:59:59"]);
        }
        elseif ($type == "year") {
            $date_1 = Carbon::create($year, 1)->startOfMonth()->format('Y-m-d')." 00:00:00";
            $query->whereBetween('created_at', [$date_1, Carbon::now()->format('y-m-d')." 23:59:59"]);
        }

        if ($state === "all") {
            return $query->count();
        }
        elseif ($state === 0) {
            return $query->count();
        }
        elseif ($state === 1) {
            return $query->count();
        }

    }

    public static function scopeAdminTotalBookings()
    {
        return EventBooking::query()->get()->count();
    }
}
