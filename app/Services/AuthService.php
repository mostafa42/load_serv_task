<?php

namespace App\Services;

use App\Models\Faq;

class AuthService
{
    protected $sharedService;
    public function __construct(SharedService $sharedService)
    {
        // Dependency is injected
        $this->sharedService = $sharedService;
    }

    public function login_page($page_path){
        return $this->sharedService->go_to($page_path, []);
    }
}
