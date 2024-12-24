<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customers\AddRequest;
use App\Http\Requests\Admin\Customers\EditRequest;
use App\Models\Customer;
use App\Services\CustomersService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerService;
    public function __construct(CustomersService $customerService)
    {
        // Dependency is injected
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if( !( $user->id == 1 || $user->can('show customer') ) ){
            abort(403);
        }

        $data = $this->customerService->get_all_paginate(10) ;

        return $this->customerService->index("customers.index", ["data" => $data]) ;
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
        if( !( $user->id == 1 || $user->can('create customer') ) ){
            abort(403);
        }


        $data = $request->all();
        $data["created_by"] = auth()->user()->id ;

        $this->customerService->store($data) ;
        return redirect()->route('customers.index');
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
        if( !( $user->id == 1 || $user->can('edit customer') ) ){
            abort(403);
        }

        $data = $this->customerService->find($id) ;
        
        return $this->customerService->index("customers.edit", ["data" => $data]) ;
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
        if( !( $user->id == 1 || $user->can('edit customer') ) ){
            abort(403);
        }

        $data = $request->all();
        $data["created_by"] = auth()->user()->id ;

        $this->customerService->update($id, $data);
        return redirect()->route('customers.index');
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
        if( !( $user->id == 1 || $user->can('delete customer') ) ){
            abort(403);
        }

        $this->customerService->delete($id) ;
        return redirect()->route('customers.index');
    }

    public function deleted_customers(){
        $user = auth()->user() ;
        if( !( $user->id == 1 || $user->can('restore customer') ) ){
            abort(403);
        }

        $data = $this->customerService->get_deleted() ;
        return $this->customerService->index("customers.deleted", ["data" => $data]) ;
    }

    public function restore_customers($id){

        $user = auth()->user();
        if( !( $user->id == 1 || $user->can('restore customer') ) ){
            abort(403);
        }


        $data["deleted_at"] = null;
        $this->customerService->restore_customers($id, $data);

        return redirect()->back();
    }
}
