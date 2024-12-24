<?php

namespace App\Http\Controllers\Admin\Employees;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employees\AddRequest;
use App\Http\Requests\Admin\Employees\EditRequest;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class EmployeesController extends Controller
{
    protected $employeeService;
    public function __construct(EmployeeService $employeeService)
    {
        // Dependency is injected
        $this->employeeService = $employeeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if( !( $user->id == 1 ) ){
            abort(403);
        }
        $data = $this->employeeService->get_pagination_with_condition(10);
        $permissions = Permission::latest()->get();
        return $this->employeeService->index('employee.index', ["data" => $data, "permissions" => $permissions]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        if( !( $user->id == 1 ) ){
            abort(403);
        }
        $inputs = $request->all();
        $user = $this->employeeService->store($inputs);
        $user->givePermissionTo($request->permissions);
        return redirect()->route('employee.index');
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
        if( !( $user->id == 1 ) ){
            abort(403);
        }
        $data = $this->employeeService->find($id) ;
        $permissions = Permission::latest()->get();

        $current_permissions = $data->getAllPermissions()->pluck('id')->toArray();
        
        return $this->employeeService->index("employee.edit", ["data" => $data, "permissions" => $permissions, "current_permissions" => $current_permissions]) ;
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
        if( !( $user->id == 1 ) ){
            abort(403);
        }
        $getting_user = $this->employeeService->find($id) ;

        $getting_user->syncPermissions([]);
        
        $data = $request->all();

        $this->employeeService->update($id, $data);

        $getting_user->givePermissionTo($request->permissions);

        return redirect()->route('employee.index');
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
        if( !( $user->id == 1 ) ){
            abort(403);
        }
        $this->employeeService->delete($id) ;
        return redirect()->route('employee.index');
    }

    public function deleted_employee(){
        $user = auth()->user();
        if( !( $user->id == 1 ) ){
            abort(403);
        }
        $data = $this->employeeService->get_deleted() ;
        return $this->employeeService->index("employee.deleted", ["data" => $data]) ;
    }

    public function restore_employee($id){
        $user = auth()->user();
        if( !( $user->id == 1 ) ){
            abort(403);
        }
        
        $data["deleted_at"] = null;
        $this->employeeService->restore_employee($id, $data);

        return redirect()->back();
    }
}
