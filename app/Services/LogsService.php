<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Faq;
use App\Models\Logs;

class LogsService
{
    protected $sharedService;
    public function __construct(SharedService $sharedService)
    {
        // Dependency is injected
        $this->sharedService = $sharedService;
    }

    public function index($page_path, $compacts){
        return $this->sharedService->go_to($page_path, $compacts);
    }

    public function get_all_paginate($limit){
        return $this->sharedService->get_all_pagination(Logs::class, $limit);
    }
}
