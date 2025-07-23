<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use Modules\Customerpanel\Http\Controllers\ChatController;
use Modules\Customerpanel\Http\Controllers\CustomerEquipmentController;
use Modules\Customerpanel\Http\Controllers\CustomerpanelController;
use Modules\Customerpanel\Http\Controllers\CustomerSubscriptionController;
use Modules\Subscription\Models\Subscription;
use Illuminate\Http\Request;




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

    // Chat Section 
    Route::get('/chat', [ChatController::class, 'index'])->name('customer.chat');
    Route::get('/chat/search', [ChatController::class, 'searchUsers']);
    Route::post('/chat/initiate/{receiver_id}', [ChatController::class, 'initiateChat']);
    Route::get('/chat/threads', [ChatController::class, 'getThreads']);
    Route::get('/chat/messages/{id}', [ChatController::class, 'fetchMessages']);
    Route::post('/chat/send', [ChatController::class, 'sendMessage']);

    
});

Route::post('/broadcasting/auth', function (Request $request) {
    // Manually authenticate with custom guard
    if (! Auth::guard('customer')->check()) {
        return response('Unauthorized.', 403);
    }

    return Broadcast::auth($request);
});






// Route::prefix('customer')->middleware(['auth.customer', 'customerrole:buyer'])->group(function () {
//     Route::get('/dashboard', [CustomerpanelController::class, 'index'])->name('customer.dashboard');
// });

Route::prefix('customer')->middleware(['auth.customer', 'customerrole:seller'])->group(function () {
    Route::get('/business-document', [CustomerpanelController::class, 'business_document'])->name('customer.business_document');
    Route::post('/upload_document', [CustomerpanelController::class, 'upload_document'])->name('customer.upload_document');
    Route::post('/delete_document', [CustomerpanelController::class, 'delete_document'])->name('customer.delete_document');
    Route::get('/enquiry', [CustomerpanelController::class, 'enquiry'])->name('customer.enquiry');
    Route::get('/enquiry/{id}', [CustomerpanelController::class, 'view_enquiry'])->name('customer.view_enquiry');

    Route::resource('/equipment', CustomerEquipmentController::class)->names('customer.equipment');
    Route::post('getEquipmentModel',[CustomerEquipmentController::class,'getEquipmentModel'])->name('customer.getEquipmentModel');
    Route::post('/delete_equipment_image', [CustomerEquipmentController::class, 'delete_equipment_image'])->name('customer.delete_equipment_image');

    //Renew Subscription
    Route::get('/subscription', [CustomerSubscriptionController::class, 'index'])->name('customer.subscription');
    Route::get('renew-start-payment', [CustomerSubscriptionController::class, 'renewstartPayment'])->name('customer.renewstartPayment');
    Route::get('renew_subscription_booking',[CustomerSubscriptionController::class, 'renew_subscription_booking'])->name('customer.renew_subscription_booking');
    Route::get('renew_subscription_success',[CustomerSubscriptionController::class, 'renew_subscription_success'])->name('customer.renew_subscription_success');
    Route::get('renew_subscription_cancel',[CustomerSubscriptionController::class, 'renew_subscription_cancel'])->name('customer.renew_subscription_cancel');
    Route::get('thankyou',[CustomerSubscriptionController::class,'thankyou'])->name('customer.thankyou');
    Route::get('oops',[CustomerSubscriptionController::class,'oops'])->name('customer.oops');

    
});