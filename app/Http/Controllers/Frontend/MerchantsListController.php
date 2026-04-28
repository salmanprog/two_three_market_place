<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\Setup\Entities\City;
use Modules\Setup\Entities\Country;
use Modules\Setup\Entities\State;

class MerchantsListController extends Controller
{
    public function __construct()
    {
        $this->middleware('maintenance_mode');
    }
    
    public function index(Request $request)
    {

        // Base query
        $query = User::where('role_id', 5)
            ->where('is_active', 1)
            ->with(['SellerAccount', 'SellerBusinessInformation', 'seller_products'])
            ->orderBy('created_at', 'desc');

        // Search sellers by name
        if ($request->filled('name')) {
            $keyword = trim((string) $request->input('name'));
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', '%'.$keyword.'%')
                    ->orWhere('last_name', 'like', '%'.$keyword.'%')
                    ->orWhereRaw("TRIM(CONCAT(COALESCE(first_name,''), ' ', COALESCE(last_name,''))) like ?", ['%'.$keyword.'%'])
                    ->orWhereHas('SellerAccount', function ($sq) use ($keyword) {
                        $sq->where('seller_shop_display_name', 'like', '%'.$keyword.'%');
                    });
            });
        }

        // Search sellers by business address fields
        $countryId = $request->input('country');
        $stateId = $request->input('state');
        $cityId = $request->input('city');
        if ($countryId || $stateId || $cityId) {
            $query->whereHas('SellerBusinessInformation', function ($q) use ($countryId, $stateId, $cityId) {
                if ($countryId) {
                    $q->where('business_country', $countryId);
                }
                if ($stateId) {
                    $q->where('business_state', $stateId);
                }
                if ($cityId) {
                    $q->where('business_city', $cityId);
                }
            });
        }

        // country options for filter dropdown (same structure as merchant step two)
        $data['countries'] = Country::where('status', 1)->orderBy('name')->get(['id', 'name']);
        $data['states'] = State::orderBy('name')->get(['id', 'name']);
        $data['cities'] = City::orderBy('name')->get(['id', 'name']);

        // paginate result
        $data['sellers'] = $query->paginate(12);

        return view(theme('pages.merchants'), $data);
    }
}