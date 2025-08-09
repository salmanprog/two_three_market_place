<?php

namespace Modules\MultiVendor\Services;

use Illuminate\Support\Facades\Validator;
use Modules\MultiVendor\Repositories\EventRepository;

class EventService{

    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function orderCommissionForAdmin($data){
        return $this->eventRepository->orderCommissionForAdmin($data);
    }

    public function orderCommissionForAdminViaFilter($data){
        return $this->eventRepository->orderCommissionForAdminViaFilter($data);
    }

}
