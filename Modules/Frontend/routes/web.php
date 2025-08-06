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
    Route::get("/verify-email","verify_email")->name("verify_email");
    Route::post("/submit_verify_email","submit_verify_email")->name("submit_verify_email");

    Route::get("/forgot-password","forgot_password")->name("forgot_password");
    Route::post('/submit_forgot_password', 'submit_forgot_password')->name('frontend.submit_forgot_password');
    Route::post('/submit_otp', 'submit_otp')->name('frontend.submit_otp');
    Route::get('/change-password', 'change_password')->name('frontend.change_password');
    Route::post('/submit_change_password',  'submit_change_password')->name('frontend.submit_change_password');

    Route::get("/advertising","advertising")->name("advertising");
    Route::get("/terms-conditions","terms_conditions")->name("terms_conditions");
    Route::get("/about-us","about_us")->name("about_us");
    Route::get("/contact-us","contact_us")->name("contact_us");
    Route::get("/products","products")->name("products");
    Route::get("/product/{slug}","product_details")->name("product_details");
    Route::get("/subscription","subscription")->name("subscription");
    Route::post("/getEquipmentModel","getEquipmentModel")->name("frontend.getEquipmentModel");
    Route::get("/seller-listing/{id}","seller_listing")->name("seller_listing");

    //Watchlist
    Route::get("/watchlist","watchlist")->name("frontend.watchlist");
    Route::post('/watchlist_toggle', 'watchlist_toggle')->name('frontend.watchlist_toggle');
    Route::post('/watchlist_item_remove', 'watchlist_item_remove')->name('frontend.watchlist_item_remove');

    //Enquiry
    Route::post('/submit_equipment_enquiry', 'submit_equipment_enquiry')->name('frontend.submit_equipment_enquiry');

    Route::get("/success","success")->name("success");
    Route::get("/oops","oops")->name("oops");


    Route::get('register_as_buyer','register_as_buyer')->name('register_as_buyer');
    // PayPal integration
    Route::get('/start-payment', 'startPayment')->name('startPayment');
    Route::get('/subscription_booking', 'subscription_booking')->name('subscription_booking');
    Route::get('/subscription_success', 'subscription_success')->name('subscription_success');
    Route::get('/subscription_cancel', 'subscription_cancel')->name('subscription_cancel');
});
