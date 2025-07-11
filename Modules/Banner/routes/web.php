<?php

use Illuminate\Support\Facades\Route;
use Modules\Banner\Http\Controllers\BannerController;


Route::group(['prefix'=>'admin','middleware'=>'auth.admin'], function () {
    Route::resource('banners', BannerController::class)->names('banner');
});
