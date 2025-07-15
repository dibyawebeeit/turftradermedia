<?php

use Illuminate\Support\Facades\Route;
use Modules\Equipment\Http\Controllers\EquipmentController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('equipment', EquipmentController::class)->names('equipment');
});
