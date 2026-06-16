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

        $usCountry = Country::where('status', 1)->where('code', 'US')->first();
        if (!$usCountry) {
            $usCountry = Country::where('status', 1)->where('name', 'United States')->first();
        }

        $selectedCountryId = $request->input('country') ?: ($usCountry?->id);
        $selectedStateId = $request->input('state');

        $data['countries'] = $usCountry ? collect([$usCountry]) : collect();
        $data['states'] = $selectedCountryId
            ? State::where('status', 1)->where('country_id', $selectedCountryId)->orderBy('name')->get(['id', 'name'])
            : collect();
        $data['cities'] = $selectedStateId
            ? City::where('status', 1)->where('state_id', $selectedStateId)->orderBy('name')->get(['id', 'name'])
            : collect();

        // paginate result
        $data['sellers'] = $query->paginate(12);

        return view(theme('pages.merchants'), $data);
    }
}