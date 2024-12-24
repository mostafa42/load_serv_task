<?php

namespace App\Http\Resources;

use App\Models\Property;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    
    public function get_customer(){
        return CustomerResource::collection([$this->customer])  ;
    }

    public function employee_data(){
        return EmployeeResource::collection([$this->added_by])  ;
    }
    
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "invoice_number" => $this->invoice_number,
            "invoice_amount" => $this->invoice_amount ,
            "invoice_date" => $this->invoice_date,
            "customer_data" => $this->get_customer(),
            "employee_data" => $this->employee_data()
        ];
    }
}