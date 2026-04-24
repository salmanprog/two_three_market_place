<?php

namespace Modules\Attendance\Repositories;

use App\Traits\ImageStore;
use Carbon\CarbonPeriod;
use DateTime;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Modules\Attendance\Entities\Attendance;
use Carbon\Carbon;
use Modules\Attendance\Entities\Event;
use Modules\Attendance\Entities\EventBooking;
use Modules\Attendance\Entities\Holiday;
use Modules\RolePermission\Repositories\RoleRepository;

class EventRepository implements EventRepositoryInterface
{

    use ImageStore;
    public function all()
    {
        if(auth()->user()->role->type != 'admin'){
            return Event::latest()->where('created_by',auth()->user()->id)->get();
        }else{
            return Event::latest()->with('user')->get();
        }
        
    }

    public function list()
    {
        return Event::latest()->get();
    }

    public function create(array $data)
    {
        $event = new Event();
        if (!empty($data['image'])) {
            $event->image = isset($data['image']) ? $this->saveImage($data['image'],1920,500) : null;
        }
        $event->title = $data['title'];
        $event->for_whom = $data['for_whom'];
        $event->location = $data['location'];
        $event->current_latitude = isset($data['current_latitude']) && $data['current_latitude'] !== '' ? $data['current_latitude'] : null;
        $event->current_longitude = isset($data['current_longitude']) && $data['current_longitude'] !== '' ? $data['current_longitude'] : null;
        $event->description = $data['description'];
        $event->price = $data['price'];
        $event->total_ticket = $data['total_ticket'];
        $event->remaining_ticket = $data['total_ticket'];
        $event->created_by = $data['created_by'];
        $event->from_date = date('Y-m-d',strtotime($data['from_date']));
        $event->to_date = date('Y-m-d',strtotime($data['to_date']));
        $event->save();

        return $event;
    }

    public function find($id)
    {
        return Event::with('user')->find($id);
    }

    public function update(array $data, $id)
    {
        $event = Event::find($id);

        if (!empty($data['image'])) {
            $old_image = Event::where('id', $id)->first();
            $this->deleteImage($old_image->image);
            $event->image = isset($data['image']) ? $this->saveImage($data['image'],1920,500) : $event->image;
        }

        
        $total_ticket = $data['total_ticket'];
        $sold_ticket = $event->sold_ticket;
        $remaining_ticket = $total_ticket - $sold_ticket;
        $event->title = $data['title'];
        $event->for_whom = $data['for_whom'];
        $event->location = $data['location'];
        $event->current_latitude = isset($data['current_latitude']) && $data['current_latitude'] !== '' ? $data['current_latitude'] : null;
        $event->current_longitude = isset($data['current_longitude']) && $data['current_longitude'] !== '' ? $data['current_longitude'] : null;
        $event->description = $data['description'];
        $event->price = $data['price'];
        $event->total_ticket = $data['total_ticket'];
        $event->remaining_ticket = $remaining_ticket;
        $event->from_date = date('Y-m-d',strtotime($data['from_date']));
        $event->to_date = date('Y-m-d',strtotime($data['to_date']));
        $event->save();

        return $event;
    }

    public function delete($id)
    {
        $event = Event::find($id);
        $this->deleteImage($event->image);
        $event->delete();
        return true;
    }

    public function roleWiseEvents()
    {
        return Event::where('for_whom','all')->orWhere('for_whom',Auth::user()->role->name)->get();
    }

    public function getbookingsall()
    {
        if(Auth::user()->role->type == 'admin'){
             return EventBooking::latest()->with('event')->with('user')->where('is_paid','1')->get();
        }else{
            return EventBooking::latest()->with('event')->with('user')->where('is_paid','1')->where('created_by',auth()->user()->id)->get();
        }
    }

    public function getAllBookingById($id)
    {
        return EventBooking::latest()->with('event')->with('user')->where('is_paid','1')->where('event_id',$id)->get();
    }

    public function getbooking($id)
    {
        return EventBooking::latest()->with('event')->with('user')->where('is_paid','1')->where('id',$id)->first();
    }
}
