<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;
    public $fillable = [
        "user_id" ,
        "log_operation" ,
        "log_model"
    ];

    public function employee(){
        return $this->belongsTo(User::class , "user_id") ;
    }

    public function getCreatedAtAttribute($value)
    {
        // Format the created_at date (you can customize this format)
        return Carbon::parse($value)->format('d-m-Y'); // Example: '2024-12-23 14:45:00'
    }
}
