<?php

use Illuminate\Support\Facades\Route;
use Modules\Cms\Http\Controllers\CmsController;




Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin'], function () {
    // Route::resource('cms', CmsController::class)->names('cms');
    Route::get('cms/about_us',[CmsController::class,'about_us'])->name('cms.about_us');
    Route::post('submit_about_us',[CmsController::class,'submit_about_us'])->name('cms.submit_about_us');

    Route::get('cms/advertising',[CmsController::class,'advertising'])->name('cms.advertising');
    Route::post('submit_advertising',[CmsController::class,'submit_advertising'])->name('cms.submit_advertising');

    Route::get('cms/contact_us',[CmsController::class,'contact_us'])->name('cms.contact_us');
    Route::post('submit_contact_us',[CmsController::class,'submit_contact_us'])->name('cms.submit_contact_us');

    Route::get('cms/terms_conditions',[CmsController::class,'terms_conditions'])->name('cms.terms_conditions');
    Route::post('submit_terms_conditions',[CmsController::class,'submit_terms_conditions'])->name('cms.submit_terms_conditions');

    Route::get('cms/home',[CmsController::class,'home'])->name('cms.home');
    Route::post('submit_home',[CmsController::class,'submit_home'])->name('cms.submit_home');
});
