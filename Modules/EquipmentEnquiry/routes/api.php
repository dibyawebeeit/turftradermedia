<?php

use Illuminate\Support\Facades\Route;
use Modules\EquipmentEnquiry\Http\Controllers\EquipmentEnquiryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('equipmentenquiries', EquipmentEnquiryController::class)->names('equipmentenquiry');
});
