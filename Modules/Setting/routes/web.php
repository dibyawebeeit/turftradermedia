<?php

use Illuminate\Support\Facades\Route;
use Modules\Setting\Http\Controllers\SettingController;


Route::group(['prefix'=>'admin','middleware'=>'auth.admin'], function () {
    Route::resource('setting', SettingController::class)->names('setting');
});
