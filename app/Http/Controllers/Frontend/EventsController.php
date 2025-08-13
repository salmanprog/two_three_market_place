<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Attendance\Entities\Event;
use Modules\Attendance\Repositories\EventRepositoryInterface;
use Modules\RolePermission\Repositories\RoleRepository;
use App\Models\User;





class EventsController extends Controller
{
    
    protected $eventRepository,$roleRepository;

    public function __construct(EventRepositoryInterface $eventRepository,RoleRepository $roleRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index(Request $request)
    {
        $data['events'] = Event::latest()->get();
        return view(theme('pages.events'), $data);
    }
}
