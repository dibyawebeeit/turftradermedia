<?php

use Illuminate\Support\Facades\Route;
use Modules\Authentication\Http\Controllers\AuthenticationController;

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('authentications', AuthenticationController::class)->names('authentication');
// });

Route::group(['prefix'=>'admin'], function () {
    Route::resource('/', AuthenticationController::class)->names('authentication');
    Route::get('/forgot-password', [AuthenticationController::class,'forgot_password'])->name('admin.forgot_password');
    
    Route::post('/submit_forgot_password', [AuthenticationController::class, 'submit_forgot_password'])->name('admin.submit_forgot_password');
    Route::post('/submit_otp', [AuthenticationController::class, 'submit_otp'])->name('admin.submit_otp');
    Route::get('/change-password', [AuthenticationController::class, 'change_password'])->name('admin.change_password');
    Route::post('/submit_change_password', [AuthenticationController::class, 'submit_change_password'])->name('admin.submit_change_password');

    Route::get('/logout', [AuthenticationController::class,'logout'])->name('admin.logout');
});
