<?php

use Illuminate\Support\Facades\Route;
use Modules\EquipmentEnquiry\Http\Controllers\EquipmentEnquiryController;

Route::group(['prefix'=>'admin','middleware'=>'auth.admin'], function () {
    Route::resource('equipmentenquiries', EquipmentEnquiryController::class)->names('equipmentenquiry');
});
