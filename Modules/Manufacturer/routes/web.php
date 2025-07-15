<?php

use Illuminate\Support\Facades\Route;
use Modules\Manufacturer\Http\Controllers\ManufacturerController;


Route::group(['prefix'=>'admin','middleware'=>'auth.admin'], function () {
    Route::resource('manufacturers', ManufacturerController::class)->names('manufacturer');
});
