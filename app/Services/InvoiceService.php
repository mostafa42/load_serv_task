<?php

namespace App\Services;

use App\Models\CustomerInvoice;
use App\Models\Faq;

class InvoiceService
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

    public function get_all(){
        return $this->sharedService->get_all(CustomerInvoice::class);
    }

    public function get_all_paginate($limit){
        if( auth()->user()->id == 1 ){
            return $this->sharedService->get_all_pagination(CustomerInvoice::class, $limit);
        }else{
            return CustomerInvoice::where("created_by", auth()->user()->id)->latest()->paginate($limit);
        }
        
    }

    public function store($data){
        return $this->sharedService->create(CustomerInvoice::class , $data) ;
    }

    public function find($id){
        return $this->sharedService->find(CustomerInvoice::class , $id);
    }

    public function update($id, $data){
        return $this->sharedService->update(CustomerInvoice::class , $id, $data) ;
    }

    public function delete($id){
        return $this->sharedService->delete(CustomerInvoice::class , $id);
    }

    public function get_deleted(){
        return $this->sharedService->get_deleted(CustomerInvoice::class) ;
    }

    public function restore_invoices($id, $data){
        return $this->sharedService->restore(CustomerInvoice::class , $id, $data) ;
    }
}
