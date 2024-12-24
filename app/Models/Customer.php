<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        "name" ,
        "phone" ,
        "email" ,
        "created_by",
        "deleted_at"
    ];

    public function added_by(){
        return $this->belongsTo(User::class , "created_by");
    }

    public function invoices(){
        return $this->hasMany(CustomerInvoice::class , "customer_id") ;
    }
}
