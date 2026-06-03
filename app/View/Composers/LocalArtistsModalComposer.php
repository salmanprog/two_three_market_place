<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Modules\Setup\Entities\City;
use Modules\Setup\Entities\Country;
use Modules\Setup\Entities\State;

class LocalArtistsModalComposer
{
    public function compose(View $view): void
    {
        $view->with('countries', Country::where('status', 1)->orderBy('name')->get(['id', 'name']));
        $view->with('states', State::orderBy('name')->get(['id', 'name']));
        $view->with('cities', City::orderBy('name')->get(['id', 'name']));
    }
}
