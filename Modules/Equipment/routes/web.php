<?php

use Illuminate\Support\Facades\Route;
use Modules\Equipment\Http\Controllers\EquipmentController;

Route::group(['prefix'=>'admin','middleware'=>'auth.admin'], function () {
    Route::resource('equipment', EquipmentController::class)->names('equipment');
    Route::post('getEquipmentModel',[EquipmentController::class,'getEquipmentModel'])->name('equipment.getEquipmentModel');
    Route::post('/delete_equipment_image', [EquipmentController::class, 'delete_equipment_image'])->name('equipment.delete_equipment_image');
});