<?php

namespace App\Http\Resources;

use App\Models\Property;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    
    public function get_customer(){
        return $this->id ;
    }

    public function employee_data(){
        return $this->id ;
    }
    
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "image" => $this->image,
            "name" => $this->name ,
            "phone" => $this->phone,
            "email" => $this->email,
        ];
    }
}