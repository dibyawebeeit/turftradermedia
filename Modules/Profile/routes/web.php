<?php

use Illuminate\Support\Facades\Route;
use Modules\Profile\Http\Controllers\ProfileController;

Route::group(['prefix'=>'admin','middleware'=>'auth.admin'], function () {
    Route::resource('profile', ProfileController::class)->names('profile');
});
