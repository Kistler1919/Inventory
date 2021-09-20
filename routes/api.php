<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\SupplierController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'v1/auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']); // Profile

});

Route::apiResource('v1/employees', EmployeeController::class);
Route::apiResource('v1/suppliers', SupplierController::class);
Route::apiResource('v1/categories', CategoryController::class);
Route::apiResource('v1/products', ProductController::class);
Route::apiResource('v1/expenses', ExpenseController::class);

Route::post('v1/salary/paid/{id}', [SalaryController::class, 'paid']);
Route::get('v1/salary/', [SalaryController::class, 'index']);
Route::get('v1/salary/view/{id}', [SalaryController::class, 'detail']);
Route::get('v1/salary/edit/{id}', [SalaryController::class, 'edit']);
Route::post('v1/salary/update/{id}', [SalaryController::class, 'updatePay']);