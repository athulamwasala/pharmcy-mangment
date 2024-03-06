<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum' )->group(function () {
      Route::get('medications', 'App\Http\Controllers\MedicationController@index');
      Route::get('customers', 'App\Http\Controllers\CustomerController@index');
    

    Route::middleware('role:owner,manager,cashier')->group(function () {
        // Routes accessible only to owners
        Route::post('medications', 'App\Http\Controllers\MedicationController@store');
        Route::put('medications/{medication}', 'App\Http\Controllers\MedicationController@update');
        Route::delete('medications/{medication}', 'App\Http\Controllers\MedicationController@destroy');
        Route::delete('medications/soft-delete/{medication}', 'App\Http\Controllers\MedicationController@softDelete');
        
        Route::post('customers', 'App\Http\Controllers\CustomerController@store');
        Route::put('customers/{customer}', 'App\Http\Controllers\CustomerController@update');
        Route::delete('customers/{customer}', 'App\Http\Controllers\CustomerController@destroy');
        Route::delete('customers/soft-delete/{customer}', 'App\Http\Controllers\CustomerController@softDelete');
    });

   

});






