<?php

use Illuminate\Support\Facades\Route;
use Modules\EquipmentModel\Http\Controllers\EquipmentModelController;


Route::group(['prefix'=>'admin','middleware'=>'auth.admin'], function () {
    Route::resource('equipmentmodels', EquipmentModelController::class)->names('equipmentmodel');
});
