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
        $events = Event::latest()->get();

        $userLat = $request->query('lat');
        $userLng = $request->query('lng');

        if ($this->isValidCoordinatePair($userLat, $userLng)) {
            $request->session()->put('organiser_events_lat', (float) $userLat);
            $request->session()->put('organiser_events_lng', (float) $userLng);
        } else {
            $userLat = $request->session()->get('organiser_events_lat');
            $userLng = $request->session()->get('organiser_events_lng');
        }

        $sortedByLocation = false;
        if ($this->isValidCoordinatePair($userLat, $userLng)) {
            $lat = (float) $userLat;
            $lng = (float) $userLng;
            $sortedByLocation = true;

            $withCoords = $events->filter(function (Event $e) {
                return $e->current_latitude !== null && $e->current_latitude !== ''
                    && $e->current_longitude !== null && $e->current_longitude !== '';
            });

            $withoutCoords = $events->filter(function (Event $e) {
                return $e->current_latitude === null || $e->current_latitude === ''
                    || $e->current_longitude === null || $e->current_longitude === '';
            });

            $withCoords = $withCoords->map(function (Event $e) use ($lat, $lng) {
                $e->setAttribute(
                    'distance_km',
                    $this->haversineKm($lat, $lng, (float) $e->current_latitude, (float) $e->current_longitude)
                );

                return $e;
            })->sortBy('distance_km')->values();

            $data['events'] = $withCoords->merge($withoutCoords->values());
        } else {
            $data['events'] = $events;
        }

        $data['eventsSortedByLocation'] = $sortedByLocation;

        return view(theme('pages.events'), $data);
    }

    protected function isValidCoordinatePair($lat, $lng): bool
    {
        if ($lat === null || $lng === null || $lat === '' || $lng === '') {
            return false;
        }
        if (! is_numeric($lat) || ! is_numeric($lng)) {
            return false;
        }
        $lat = (float) $lat;
        $lng = (float) $lng;

        return $lat >= -90 && $lat <= 90 && $lng >= -180 && $lng <= 180;
    }

    protected function haversineKm(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthKm = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) ** 2
            + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) ** 2;

        return $earthKm * 2 * atan2(sqrt($a), sqrt(1 - $a));
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
            $data['booking_event'] = EventBooking::create($request->except('_token'));
            Toastr::success(__('common.created_successfully'), __('common.success'));
            LogActivity::successLog('Event Book Successfully.');
            //return redirect()->route('frontend.event.book.show',['id'=>$request->event_id,'userid'=>$request->user_id]);
            
            return redirect()->to('event/booking/payment/'.$request->event_id.'/'.auth()->user()->id);
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

    public function userBookingEvent()
    {
        $data['bookingevents'] = EventBooking::with('event')->with('user')->where('user_id',auth()->user()->id)->where('is_paid','1')->orderBy('id', 'desc')->get();
        return view(theme('pages.user_event_booking'), $data);
    }

    public function userBookingEventDetail($id)
    {
        $data['bookingevents'] = EventBooking::with('event')->with('user')->where('id',$id)->where('is_paid','1')->first();
        return view(theme('pages.user_event_booking_detail'), $data);
    }

    public function sellerBookingEvent()
    {
        $data['bookingevents'] = EventBooking::with('event')->with('user')->where('user_id',auth()->user()->id)->where('is_paid','1')->orderBy('id', 'desc')->get();
        return view(theme('pages.seller_event_booking'), $data);
    }

    public function sellerBookingEventDetail($id)
    {
        $data['bookingevents'] = EventBooking::with('event')->with('user')->where('id',$id)->where('is_paid','1')->first();
        return view(theme('pages.seller_event_booking_detail'), $data);
    }

}
