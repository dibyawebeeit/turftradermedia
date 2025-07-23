<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\CustomerController;


Route::group(['prefix'=>'admin','middleware'=>'auth.admin'], function () {
    Route::resource('customers', CustomerController::class)->names('customer');
    Route::post('/export-customers', [CustomerController::class, 'exportCustomers'])->name('exportCustomers');
});