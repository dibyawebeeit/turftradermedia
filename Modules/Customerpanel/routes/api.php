<?php

use Illuminate\Support\Facades\Route;
use Modules\Customerpanel\Http\Controllers\CustomerpanelController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('customerpanels', CustomerpanelController::class)->names('customerpanel');
});
