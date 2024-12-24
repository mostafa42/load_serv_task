<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Services\AuthService;
use App\Services\SharedService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        // Dependency is injected
        $this->authService = $authService;
    }

    public function login_page()
    {
        return $this->authService->login_page("welcome");
    }

    public function login_action(LoginRequest $request)
    {

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid Credentials'])->withInput();
        }

        return $request;
    }

    public function logout(){
        auth()->logout();

        return redirect()->route('login_page');
    }

    public function home(){
        return view('admins.home');
    }
}
