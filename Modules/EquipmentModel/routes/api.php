<?php

use Illuminate\Support\Facades\Route;
use Modules\EquipmentModel\Http\Controllers\EquipmentModelController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('equipmentmodels', EquipmentModelController::class)->names('equipmentmodel');
});
