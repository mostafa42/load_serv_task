<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\InvoicesRepositoryInterface;
use App\Http\Requests\Admin\Invoices\AddRequest;
use App\Http\Requests\Admin\Invoices\EditRequest;
use App\Models\CustomerInvoice;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    protected $invoiceRepository;

    public function __construct(InvoicesRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
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
            return response()->json(res("en", error(), 'donot_have_permission', []), 404);
        }

        $result = $this->invoiceRepository->index();

        return response(res('en', success(), 'done', $result), 200);
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
            return response()->json(res("en", error(), 'donot_have_permission', []), 404);
        }
        $inputs = $request->all();
        $inputs["created_by"] = auth()->user()->id;
        $inputs["invoice_number"] = "LoadServ_" . ( CustomerInvoice::latest()->first() ?  CustomerInvoice::latest()->first()->id : 1 ) . "_Invoice" ;
        
        $result = $this->invoiceRepository->store($inputs);

        return response(res('en', success(), 'done', $result), 200);
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
        //
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
            return response()->json(res("en", error(), 'donot_have_permission', []), 404);
        }

        $inputs = $request->all();
        $inputs["created_by"] = auth()->user()->id;
        $inputs["invoice_number"] = "LoadServ_" . ( CustomerInvoice::latest()->first() ?  CustomerInvoice::latest()->first()->id : 1 ) . "_Invoice" ;

        $result = $this->invoiceRepository->update($inputs, $id);

        return response(res('en', success(), 'done', $result), 200);
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
            return response()->json(res("en", error(), 'donot_have_permission', []), 404);
        }
        
        $result = $this->invoiceRepository->delete($id);

        return response(res('en', success(), 'done', $result), 200);
    }
}
