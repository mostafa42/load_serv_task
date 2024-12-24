<?php

namespace App\Observers;

use App\Mail\InvoiceMail;
use App\Models\CustomerInvoice;
use App\Models\CustomerInvoices;
use App\Models\Logs;
use App\Services\SharedService;

class CustomerInvoiceObserver
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
    public function created(CustomerInvoice $customer)
    {
        $data["user_id"] = auth()->user()->id;
        $data["log_operation"] = "create";
        $data["log_model"] = "invoice";
        $this->sharedService->create(Logs::class, $data);

        $details = [
            'name' => $customer->customer->name,
            'number' => $customer->invoice_number ,
            'amount' => number_format($customer->invoice_amount, 2) ,
        ];



        \Mail::to($customer->customer->email)->send(new InvoiceMail($details));
    }

    /**
     * Handle the Customer "updated" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function updated(CustomerInvoice $customer)
    {
        $data["user_id"] = auth()->user()->id;
        $data["log_operation"] = "update";
        $data["log_model"] = "invoice";
        $this->sharedService->create(Logs::class, $data);

        $details = [
            'name' => $customer->customer->name,
            'number' => $customer->invoice_number ,
            'amount' => number_format($customer->invoice_amount, 2) ,
        ];



        \Mail::to($customer->customer->email)->send(new InvoiceMail($details));
    }

    /**
     * Handle the Customer "deleted" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function deleted(CustomerInvoice $customer)
    {
        $data["user_id"] = auth()->user()->id;
        $data["log_operation"] = "delete";
        $data["log_model"] = "invoice";
        $this->sharedService->create(Logs::class, $data);
    }

    /**
     * Handle the Customer "restored" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function restored(CustomerInvoice $customer)
    {
        $data["user_id"] = auth()->user()->id;
        $data["log_operation"] = "restore";
        $data["log_model"] = "invoice";
        $this->sharedService->create(Logs::class, $data);
    }

    /**
     * Handle the Customer "force deleted" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function forceDeleted(CustomerInvoice $customer)
    {
        //
    }
}
