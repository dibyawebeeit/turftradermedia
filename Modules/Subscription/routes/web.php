<?php

use Illuminate\Support\Facades\Route;
use Modules\Subscription\Http\Controllers\SubscriptionController;

Route::group(['prefix'=>'admin','middleware'=>'auth.admin'], function () {
    Route::resource('subscriptions', SubscriptionController::class)->names('subscription');
    Route::post('/export-subscription', [SubscriptionController::class, 'exportSubscriptions'])->name('exportSubscriptions');
});
