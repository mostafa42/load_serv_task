<?php

namespace App\Http\Eloquent;

use App\Http\Interfaces\InvoicesRepositoryInterface;
use App\Http\Resources\InvoiceResource;
use App\Models\CustomerInvoice;
use App\Services\SharedService;
use Illuminate\Support\Facades\Auth;

class InvoicesRepository implements InvoicesRepositoryInterface
{
    protected $sharedService;
    public function __construct(SharedService $sharedService)
    {
        // Dependency is injected
        $this->sharedService = $sharedService;
    }

    public function index()
    {
        $user = auth()->user() ;
        $data = [] ;
        if( $user->id == 1 ){
            $data = $this->sharedService->get_all(CustomerInvoice::class) ;
        }else{
            $data = $this->sharedService->get_by_condition(CustomerInvoice::class, "created_by", $user->id);
        }

        return InvoiceResource::collection($data);
    }

    public function store($request){
        return $data = $this->sharedService->create(CustomerInvoice::class, $request) ;
    }

    public function update($request, $id){
        return $data = $this->sharedService->update(CustomerInvoice::class, $id, $request) ;
    }

    public function delete($id){
        return $data = $this->sharedService->delete(CustomerInvoice::class, $id) ;
    }
}