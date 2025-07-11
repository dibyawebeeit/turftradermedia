<?php

use Illuminate\Support\Facades\Route;
use Modules\Subscriptionplan\Http\Controllers\SubscriptionplanController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('subscriptionplans', SubscriptionplanController::class)->names('subscriptionplan');
});
