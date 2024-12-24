<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerInvoice extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        "customer_id" ,
        "invoice_number" ,
        "invoice_amount" ,
        "invoice_date" ,
        "created_by" ,
        "deleted_at"
    ];

    public function added_by(){
        return $this->belongsTo(User::class , "created_by");
    }

    public function customer(){
        return $this->belongsTo(Customer::class , "customer_id")->withTrashed();
    }

    // scoping for searching
    public function scopeFilter($query, $data)
    {
        if ($data['customer_id']) {
            $query->where("customer_id", $data['customer_id']);
        }

        if ($data['invoice_number']) {
            $query->where("invoice_number", $data['invoice_number']);
        }

        if ($data['invoice_amount']) {
            $query->where("invoice_amount", $data['invoice_amount']);
        }

        if ($data['invoice_date']) {
            $query->where("invoice_date", $data['invoice_date']);
        }

        return $query;
    }
}
