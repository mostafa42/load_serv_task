<?php

use App\Http\Controllers\Admin\Auth\AuthenticationController;
use App\Http\Controllers\Admin\Customer\CustomerController;
use App\Http\Controllers\Admin\Employees\EmployeesController;
use App\Http\Controllers\Admin\Invoices\InvoiceController;
use App\Http\Controllers\Admin\Logs\LogsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login_page');
});


Route::controller(AuthenticationController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', 'login_page')->name('login_page');
        Route::post('login-action', 'login_action')->name('login_action');
    });
    Route::post('logout', 'logout')->name('logout');
    Route::get('home', 'home')->name('home');
});


Route::resource('customers', CustomerController::class);
Route::controller(CustomerController::class)->group(function () {
    Route::get('deleted-customers', 'deleted_customers')->name('deleted_customers');
    Route::post('restore-customer/{id}', 'restore_customers')->name('restore_customers');
});
Route::resource('invoices', InvoiceController::class);
Route::controller(InvoiceController::class)->group(function () {
    Route::get('deleted-invoices', 'deleted_invoices')->name('deleted_invoices');
    Route::post('restore-invoices/{id}', 'restore_invoices')->name('restore_invoices');
    Route::get('invoice-search', 'invoice_search')->name('invoice_search');
});

Route::resource('employee', EmployeesController::class);
Route::controller(EmployeesController::class)->group(function () {
    Route::get('deleted-employee', 'deleted_employee')->name('deleted_employee');
    Route::post('restore-employee/{id}', 'restore_employee')->name('restore_employee');
});

Route::resource('logs', LogsController::class);

