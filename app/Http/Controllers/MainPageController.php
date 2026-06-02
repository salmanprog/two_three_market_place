<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index() {
        return view('frontend.amazy.pages.drop-down-pages.main-page.index');
    }
}
