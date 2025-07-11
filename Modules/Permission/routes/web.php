<?php

use Illuminate\Support\Facades\Route;
use Modules\Permission\Http\Controllers\PermissionController;


Route::group(['prefix'=>'admin','middleware'=>'auth.admin'], function () {
    Route::resource('permission', PermissionController::class)->names('permission');
});
