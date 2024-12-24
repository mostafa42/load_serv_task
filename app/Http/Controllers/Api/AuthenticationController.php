<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\AuthenticationRepositoryInterface;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{

    protected $authRepository;

    public function __construct(AuthenticationRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }


    public function login(LoginRequest $request)
    {
        $result = $this->authRepository->login($request);

        if( !$result ){
            return response()->json(res("en", error(), 'invalid_credentials', []), 403);
        }

        return response(res('en', success(), 'success_auth', $result), 200);
    }
}
