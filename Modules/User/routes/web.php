<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

Route::group(['prefix'=>'admin','middleware'=>'auth.admin'], function () {
    Route::resource('users', UserController::class)->names('user');
});
