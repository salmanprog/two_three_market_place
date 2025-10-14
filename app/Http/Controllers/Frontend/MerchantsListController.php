<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

        // Apply search filter if search keyword exists
        if (!empty($request->input('search_artist'))) {
        $users = DB::table('customer_addresses')
            ->when($request->input('search'), function ($q, $value) {
                $q->where('name', $value);
            })
            ->when($request->input('city'), function ($q, $value) {
                $q->orWhere('city', $value);
            })
            ->when($request->input('state'), function ($q, $value) {
                $q->orWhere('state', $value);
            })
            ->when($request->input('country'), function ($q, $value) {
                $q->orWhere('country', $value);
            })
            ->when($request->input('postal_code'), function ($q, $value) {
                $q->orWhere('postal_code', $value);
            })
            ->pluck('customer_id')
            ->toArray();

        if (!empty($users)) {
            $query->whereIn('id', $users);
        }
        }

        // paginate result
        $data['sellers'] = $query->paginate(12);

        return view(theme('pages.merchants'), $data);
    }
}