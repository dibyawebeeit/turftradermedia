<?php

use Illuminate\Support\Facades\Route;
use Modules\Ads\Http\Controllers\AdsController;

Route::group(['prefix'=>'admin','middleware'=>'auth.admin'], function () {
    Route::resource('ads', AdsController::class)->names('ads');
});
