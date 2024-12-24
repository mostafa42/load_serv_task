<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Faq;
use App\Models\User;

    class EmployeeService
    {
        protected $sharedService;
        public function __construct(SharedService $sharedService)
        {
            // Dependency is injected
            $this->sharedService = $sharedService;
        }

        public function index($page_path, $compacts)
        {
            return $this->sharedService->go_to($page_path, $compacts);
        }

        public function get_all_paginate($limit)
        {
            return $this->sharedService->get_all_pagination(User::class, $limit); 
        }

        public function get_pagination_with_condition($limit){
            return User::where("id", "!=", auth()->user()->id)->latest()->paginate($limit) ;
        }

        public function get_all()
        {
            return $this->sharedService->get_all(User::class);
        }

        public function store($data)
        {
            return $this->sharedService->create(User::class, $data);
        }

        public function find($id)
        {
            return $this->sharedService->find(User::class, $id);
        }

        public function update($id, $data)
        {
            return $this->sharedService->update(User::class, $id, $data);
        }

        public function delete($id)
        {
            return $this->sharedService->delete(User::class, $id);
        }

        public function get_deleted()
        {
            return $this->sharedService->get_deleted(User::class);
        }

        public function restore_employee($id, $data)
        {
            return $this->sharedService->restore(User::class, $id, $data);
        }
    }
