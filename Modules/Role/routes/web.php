<?php

use Illuminate\Support\Facades\Route;
use Modules\Role\Http\Controllers\RoleController;


Route::group(['prefix'=>'admin','middleware'=>'auth.admin'], function () {
    Route::resource('role', RoleController::class)->names('role');
});
