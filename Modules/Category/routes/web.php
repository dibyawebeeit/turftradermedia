<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;

Route::group(['prefix'=>'admin','middleware'=>'auth.admin'], function () {
    Route::resource('categories', CategoryController::class)->names('category');
});
