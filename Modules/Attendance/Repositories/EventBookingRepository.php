<?php

namespace Modules\Attendance\Repositories;

use App\Traits\ImageStore;
use Carbon\CarbonPeriod;
use DateTime;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Modules\Attendance\Entities\Attendance;
use Carbon\Carbon;
use Modules\Attendance\Entities\EventBooking;
use Modules\Attendance\Entities\Holiday;
use Modules\RolePermission\Repositories\RoleRepository;

class EventBookingRepository implements EventBookingRepositoryInterface
{

    use ImageStore;
    public function all()
    {
        if(auth()->user()->role->type != 'superadmin'){
            return EventBooking::latest()->where('created_by',auth()->user()->id)->get();
        }else{
            return EventBooking::latest()->get();
        }
        
    }

    public function list()
    {
        return EventBooking::latest()->get();
    }

    public function create(array $data)
    {
        $event = new EventBooking();
        
        $event->event_id = $data['event_id'];
        $event->user_id = $data['user_id'];
        $event->no_of_ticket = $data['no_of_ticket'];
        $event->tx_id = $data['tx_id'];
        $event->is_paid = $data['is_paid'];
        $event->purchase_date = $data['purchase_date'];
        $event->status = $data['status'];
        $event->save();

        return $event;
    }

    public function find($id)
    {
        return EventBooking::find($id);
    }

    public function update(array $data, $id)
    {
        $event = EventBooking::find($id);

        if (!empty($data['image'])) {
            $old_image = EventBooking::where('id', $id)->first();
            $this->deleteImage($old_image->image);
            $event->image = isset($data['image']) ? $this->saveImage($data['image'],1920,500) : $event->image;
        }

        
        $total_ticket = $data['total_ticket'];
        $sold_ticket = $event->sold_ticket;
        $remaining_ticket = $total_ticket - $sold_ticket;
        $event->title = $data['title'];
        $event->for_whom = $data['for_whom'];
        $event->location = $data['location'];
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
        $event = EventBooking::find($id);
        $this->deleteImage($event->image);
        $event->delete();
        return true;
    }

    public function roleWiseEvents()
    {
        return EventBooking::where('for_whom','all')->orWhere('for_whom',Auth::user()->role->name)->get();
    }
}
