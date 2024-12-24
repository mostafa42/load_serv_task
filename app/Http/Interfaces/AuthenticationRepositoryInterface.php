<?php

namespace App\Http\Interfaces;

interface AuthenticationRepositoryInterface
{
    public function login($request);
}
