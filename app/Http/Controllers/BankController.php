<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Account\DataTable\BankAccountDataTable;
use Modules\Account\Http\Requests\BankAccountRequest;
use Modules\Account\Services\BankAccountService;
use Modules\UserActivityLog\Traits\LogActivity;


class BankController extends Controller
{   
    public function index(Request $request)
    {
        return view(theme('pages.profile.bank'));
    }
}
