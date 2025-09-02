<?php

namespace Modules\MultiVendor\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Carbon\Carbon;

class SellerAccount extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function commission_type()
    {
        return $this->belongsTo(SellerCommssionType::class, 'seller_commission_id')->withDefault();
    }

    public function scopeSellerInfo($query, $type, $state)
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
}
