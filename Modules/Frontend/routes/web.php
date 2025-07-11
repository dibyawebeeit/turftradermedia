<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\Http\Controllers\FrontendController;

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('frontends', FrontendController::class)->names('frontend');
// });

Route::controller(FrontendController::class)->group(function(){
    Route::get("/","index")->name("home");
    Route::get("/signin","signin")->name("signin");
    Route::get("/register","register")->name("register");
    Route::get("/advertising","advertising")->name("advertising");
    Route::get("/about-us","about_us")->name("about_us");
    Route::get("/contact-us","contact_us")->name("contact_us");
    Route::get("/products","products")->name("products");
    Route::get("/product/{slug}","product_details")->name("product_details");
});
