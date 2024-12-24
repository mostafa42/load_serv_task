<?php

namespace App\Observers;

use App\Models\Customer;
use App\Models\Logs;
use App\Services\SharedService;

class CustomerObserver
{
    protected $sharedService;
    public function __construct(SharedService $sharedService)
    {
        // Dependency is injected
        $this->sharedService = $sharedService;
    }

    /**
     * Handle the Customer "created" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function created(Customer $customer)
    {
        $data["user_id"] = auth()->user()->id ;
        $data["log_operation"] = "create" ;
        $data["log_model"] = "customer" ;
        $this->sharedService->create(Logs::class, $data) ;
    }

    /**
     * Handle the Customer "updated" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function updated(Customer $customer)
    {
        $data["user_id"] = auth()->user()->id ;
        $data["log_operation"] = "update" ;
        $data["log_model"] = "customer" ;
        $this->sharedService->create(Logs::class, $data) ;
    }

    /**
     * Handle the Customer "deleted" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function deleted(Customer $customer)
    {
        $data["user_id"] = auth()->user()->id ;
        $data["log_operation"] = "delete" ;
        $data["log_model"] = "customer" ;
        $this->sharedService->create(Logs::class, $data) ;
    }

    /**
     * Handle the Customer "restored" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function restored(Customer $customer)
    {
        $data["user_id"] = auth()->user()->id ;
        $data["log_operation"] = "restore" ;
        $data["log_model"] = "customer" ;
        $this->sharedService->create(Logs::class, $data) ;
    }

    /**
     * Handle the Customer "force deleted" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function forceDeleted(Customer $customer)
    {
        //
    }
}
