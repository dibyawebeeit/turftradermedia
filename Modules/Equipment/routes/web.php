<?php

use Illuminate\Support\Facades\Route;
use Modules\Equipment\Http\Controllers\EquipmentController;

Route::group(['prefix'=>'admin','middleware'=>'auth.admin'], function () {
    Route::resource('equipment', EquipmentController::class)->names('equipment');
});