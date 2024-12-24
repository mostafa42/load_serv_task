<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'name',
        'phone',
        'email',
        'password',
        "deleted_at" ,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    protected function getImageAttribute($value)
    {
        if ($value) {
            return asset('employees' . '/' . $value);
        } else {
            return asset('employees/default.webp');
        }
    }

    public function setImageAttribute($value)
    {
        if ($value) {
            $imageName = time() . '.' . $value->getClientOriginalExtension();
            $value->move(public_path('employees/'), $imageName);
            $this->attributes['image'] = $imageName;
        }
    }

    public function my_invoices(){
        return $this->hasMany(CustomerInvoice::class, "created_by");
    }
}
