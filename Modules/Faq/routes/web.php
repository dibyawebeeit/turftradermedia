<?php

use Illuminate\Support\Facades\Route;
use Modules\Faq\Http\Controllers\FaqController;


Route::group(['prefix'=>'admin','middleware'=>'auth.admin'], function () {
    Route::resource('faq', FaqController::class)->names('faq');
});
