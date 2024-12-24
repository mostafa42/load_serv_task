<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\InvoicesController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => ['api'],
], function ($router) {
    Route::controller(AuthenticationController::class)->group(function () {
        Route::post('login', 'login');
    });

    if (request()->header('Authorization')) {
        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::resource('invoices', InvoicesController::class);
        });
    }
});
