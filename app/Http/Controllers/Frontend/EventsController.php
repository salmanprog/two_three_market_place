<?php

namespace App\Http\Controllers\Frontend;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Attendance\Entities\Event;
use Modules\Attendance\Repositories\EventRepositoryInterface;
use Modules\Attendance\Entities\EventBooking;
use Modules\Attendance\Repositories\EventBookingRepositoryInterface;
use Modules\RolePermission\Repositories\RoleRepository;
use App\Models\User;
use Modules\UserActivityLog\Traits\LogActivity;




class EventsController extends Controller
{
    
    protected $eventRepository,$roleRepository,$eventbookingRepository;

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

    public function show($id)
    {
        $data['events'] = Event::where('id',$id)->first();
        return view(theme('pages.event_detail'), $data);
    }

    public function createBooking(Request $request)
    {
        $request->validate([
            'event_id' => 'required',
            'user_id' => 'required',
            'no_of_ticket' => 'required',
            'is_paid' => 'required',
            'purchase_date' => 'required'
        ]);

        try {
            EventBooking::create($request->except('_token'));
            Toastr::success(__('common.created_successfully'), __('common.success'));
            LogActivity::successLog('Event Book Successfully.');
            return redirect()->route('frontend.event.book.show',['id'=>$request->event_id,'userid'=>$request->user_id]);
        } catch (\Exception $e) {
            Toastr::error(__($e->getMessage()), __('common.error'));
            LogActivity::errorLog($e->getMessage());
            return back();
        }
        
    }

    public function bookingEventShow($id,$userid)
    {
        $data['events'] = Event::where('id',$id)->first();
        $data['bookingevents'] = EventBooking::where('event_id',$id)->where('user_id',$userid)->orderBy('id', 'desc')->first();
        return view(theme('pages.event_booking'), $data);
    }

}
