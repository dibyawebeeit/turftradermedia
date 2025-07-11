<?php

use Illuminate\Support\Facades\Route;
use Modules\Authentication\Http\Controllers\AuthenticationController;

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('authentications', AuthenticationController::class)->names('authentication');
// });

Route::group(['prefix'=>'admin'], function () {
    Route::resource('/', AuthenticationController::class)->names('authentication');
    Route::get('/logout', [AuthenticationController::class,'logout'])->name('admin.logout');
});
