<?php

namespace App\Http\Controllers\Admin\Invoices;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Invoices\AddRequest;
use App\Http\Requests\Admin\Invoices\EditRequest;
use App\Models\CustomerInvoice;
use App\Services\CustomersService;
use App\Services\InvoiceService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected $invoiceService, $customersService;
    public function __construct(InvoiceService $invoiceService, CustomersService $customersService)
    {
        // Dependency is injected
        $this->invoiceService = $invoiceService;
        $this->customersService = $customersService ;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if( !( $user->id == 1 || $user->can('show invoice') ) ){
            abort(403) ;
        }

        $data = $this->invoiceService->get_all_paginate(10) ;

        $customers = $this->customersService->get_all();

        return $this->invoiceService->index("invoices.index", ["data" => $data, "customers" => $customers]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request)
    {
        $user = auth()->user();
        if( !( $user->id == 1 || $user->can('create invoice') ) ){
            abort(403) ;
        }

        $data = $request->all();
        $data["created_by"] = auth()->user()->id ;
        $data["invoice_number"] = "LoadServ_" . ( CustomerInvoice::latest()->first() ?  CustomerInvoice::latest()->first()->id : 1 ) . "_Invoice" ;

        $this->invoiceService->store($data) ;
        return redirect()->route('invoices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        if( !( $user->id == 1 || $user->can('edit invoice') ) ){
            abort(403) ;
        }

        $data = $this->invoiceService->find($id) ;
        
        if( !auth()->user()->id && $data->created_by != auth()->user()->id ){
            return abort(404) ;
        }

        $customers = $this->customersService->get_all();
        
        return $this->invoiceService->index("invoices.edit", ["data" => $data, "customers" => $customers]) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, $id)
    {
        $user = auth()->user();
        if( !( $user->id == 1 || $user->can('edit invoice') ) ){
            abort(403) ;
        }

        $find = $this->invoiceService->find($id) ;
        
        if( !auth()->user()->id && $find->created_by != auth()->user()->id ){
            return abort(404) ;
        }

        $data = $request->all();
        $data["created_by"] = auth()->user()->id ;
        
        $this->invoiceService->update($id, $data);
        return redirect()->route('invoices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();
        if( !( $user->id == 1 || $user->can('delete invoice') ) ){
            abort(403) ;
        }

        $find = $this->invoiceService->find($id) ;
        
        if( !auth()->user()->id && $find->created_by != auth()->user()->id ){
            return abort(404) ;
        }

        $this->invoiceService->delete($id) ;
        return redirect()->route('invoices.index');
    }

    public function deleted_invoices(){
        $user = auth()->user();
        if( !( $user->id == 1 || $user->can('restore invoice') ) ){
            abort(403) ;
        }


        $data = $this->invoiceService->get_deleted() ;
        return $this->invoiceService->index("invoices.deleted", ["data" => $data]) ;
    }

    public function restore_invoices($id){
        $user = auth()->user();
        if( !( $user->id == 1 || $user->can('restore invoice') ) ){
            abort(403) ;
        }

        $find = $this->invoiceService->find($id) ;
        
        if( !auth()->user()->id && $find->created_by != auth()->user()->id ){
            return abort(404) ;
        }


        $data["deleted_at"] = null;
        $this->invoiceService->restore_invoices($id, $data);

        return redirect()->back();
    }

    public function invoice_search(Request $request){
        if( auth()->user()->id != 1 ){
            return abort(403) ;
        }
        
        $data = CustomerInvoice::filter($request)->latest()->paginate(10);
        $customers = $this->customersService->get_all();

        return $this->invoiceService->index("invoices.search", ["data" => $data, "customers" => $customers, "request" => $request]) ;
    }
}
