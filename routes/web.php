<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'authLogin']);
Route::get('logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'admin'], function() {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    // Employee Routes
    Route::get('admin/employee/list', [EmployeeController::class, 'employeeList']);
    Route::get('admin/employee/add', [EmployeeController::class, 'add']);
    Route::post('admin/employee/add', [EmployeeController::class, 'insert']);
    Route::get('admin/employee/add-details/{id}', [EmployeeController::class, 'showAddDetailsForm']);
    Route::post('admin/employee/add-details', [EmployeeController::class, 'addDetails']);
    Route::get('admin/employee/add-contact/{id}', [EmployeeController::class, 'showAddContactForm']);
    Route::post('admin/employee/add-contact', [EmployeeController::class, 'addContact']);
});

Route::group(['middleware' => 'employee'], function() {
    Route::get('employee/dashboard', [DashboardController::class, 'dashboard']);
});
