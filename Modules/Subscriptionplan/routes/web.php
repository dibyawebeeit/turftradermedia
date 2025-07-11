<?php

use Illuminate\Support\Facades\Route;
use Modules\Subscriptionplan\Http\Controllers\SubscriptionplanController;

Route::group(['prefix'=>'admin','middleware'=>'auth.admin'], function () {
    Route::resource('subscriptionplans', SubscriptionplanController::class)->names('subscriptionplan');
});
