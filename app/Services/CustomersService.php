<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Faq;

class CustomersService
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
        if( auth()->user()->id == 1 ){
            return $this->sharedService->get_all_pagination(Customer::class, $limit);
        }else{
            return Customer::where("created_by", auth()->user()->id)->latest()->paginate($limit);
        }
        
    }

    public function get_all(){
        return $this->sharedService->get_all(Customer::class);
    }

    public function store($data){
        return $this->sharedService->create(Customer::class , $data) ;
    }

    public function find($id){
        return $this->sharedService->find(Customer::class , $id);
    }

    public function update($id, $data){
        return $this->sharedService->update(Customer::class , $id, $data) ;
    }

    public function delete($id){
        return $this->sharedService->delete(Customer::class , $id);
    }

    public function get_deleted(){
        return $this->sharedService->get_deleted(Customer::class) ;
    }

    public function restore_customers($id, $data){
        return $this->sharedService->restore(Customer::class , $id, $data) ;
    }
}
