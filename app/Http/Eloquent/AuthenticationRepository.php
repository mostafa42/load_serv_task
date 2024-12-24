<?php

namespace App\Http\Eloquent;

use App\Http\Interfaces\AuthenticationRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuthenticationRepository implements AuthenticationRepositoryInterface
{
    public function login($request)
    {
        $success = [];

        // check if vendor
        if (
            Auth::attempt(['email' => $request->email, 'password' => $request->password])
        ) {

            $vendor = Auth::user();

            $success['token'] =  $vendor->createToken('MyApp')->plainTextToken;

            $success['data'] =  $vendor;

            return $success ;
            
        }else {
            return false ;
        }
    }
}