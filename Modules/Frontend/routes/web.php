<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\Http\Controllers\FrontendController;

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('frontends', FrontendController::class)->names('frontend');
// });

Route::controller(FrontendController::class)->group(function(){
    Route::get("/","index")->name("home");
    Route::get("/signin","signin")->name("signin");
    Route::post("/submit_signin","submit_signin")->name("submit_signin");
    Route::get("/register","register")->name("register");
    Route::post("/submit_register","submit_register")->name("submit_register");
    Route::get("/advertising","advertising")->name("advertising");
    Route::get("/about-us","about_us")->name("about_us");
    Route::get("/contact-us","contact_us")->name("contact_us");
    Route::get("/products","products")->name("products");
    Route::get("/product/{slug}","product_details")->name("product_details");
    Route::get("/subscription","subscription")->name("subscription");
    Route::post("/getEquipmentModel","getEquipmentModel")->name("frontend.getEquipmentModel");

    Route::get("/success","success")->name("success");
    Route::get("/oops","oops")->name("oops");


    // PayPal integration
    Route::get('/start-payment', 'startPayment')->name('startPayment');
    Route::get('/subscription_booking', 'subscription_booking')->name('subscription_booking');
    Route::get('/subscription_success', 'subscription_success')->name('subscription_success');
    Route::get('/subscription_cancel', 'subscription_cancel')->name('subscription_cancel');
});
