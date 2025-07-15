<?php

use Illuminate\Support\Facades\Route;
use Modules\Customerpanel\Http\Controllers\CustomerEquipmentController;
use Modules\Customerpanel\Http\Controllers\CustomerpanelController;


// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('customerpanels', CustomerpanelController::class)->names('customerpanel');
// });


Route::prefix('customer')->middleware(['auth.customer', 'customerrole:buyer,seller'])->group(function () {
    Route::get('/dashboard', [CustomerpanelController::class, 'index'])->name('customer.dashboard');
    Route::get('/profile-setting', [CustomerpanelController::class, 'profile_setting'])->name('customer.profile_setting');
    Route::post('/update_profile', [CustomerpanelController::class, 'update_profile'])->name('customer.update_profile');
    Route::get('/change-password', [CustomerpanelController::class, 'change_password'])->name('customer.change_password');
    Route::post('/update_password', [CustomerpanelController::class, 'update_password'])->name('customer.update_password');
    Route::get('/logout', [CustomerpanelController::class, 'logout'])->name('customer.logout');
});


// Route::prefix('customer')->middleware(['auth.customer', 'customerrole:buyer'])->group(function () {
//     Route::get('/dashboard', [CustomerpanelController::class, 'index'])->name('customer.dashboard');
// });

Route::prefix('customer')->middleware(['auth.customer', 'customerrole:seller'])->group(function () {
    Route::get('/business-document', [CustomerpanelController::class, 'business_document'])->name('customer.business_document');
    Route::post('/upload_document', [CustomerpanelController::class, 'upload_document'])->name('customer.upload_document');
    Route::post('/delete_document', [CustomerpanelController::class, 'delete_document'])->name('customer.delete_document');

    Route::resource('/equipment', CustomerEquipmentController::class)->names('customer.equipment');
});