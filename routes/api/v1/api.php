<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\CustomerAuthController;
use App\Http\Controllers\Api\V1\Auth\PasswordResetController;
use App\Http\Controllers\Api\V1\FlightDetailController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\TravelerController;
use App\Http\Controllers\Api\V1\ReviewController;
use App\Http\Controllers\Api\V1\DisputeController;
use App\Http\Controllers\Api\V1\MessageController;

Route::group(['namespace' => 'Api\V1'], function () {

    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {

        Route::post('check-email', [CustomerAuthController::class, 'check_email']);
        Route::post('verify-email', [CustomerAuthController::class, 'verify_email']);

        Route::post('register', [CustomerAuthController::class, 'register']);
        Route::post('login', [CustomerAuthController::class, 'login']);

        Route::post('social-login', [CustomerAuthController::class, 'social_login']);

        Route::post('loginbyphone', [CustomerAuthController::class, 'loginByPhone']);
        
        Route::post('verify-phone', [CustomerAuthController::class, 'verify_phone']);
       
       
        Route::post('forgot-password', [PasswordResetController::class, 'reset_password_request']);
        Route::post('verify-token', [PasswordResetController::class, 'verify_token']);

        Route::put('reset-password', [PasswordResetController::class, 'reset_password_submit']);



        Route::group(['prefix' => 'order'], function () {

            Route::post('new-order', [OrderController::class, 'store']);
        });

    });




    Route::group(['prefix' => 'flight-detail'], function () {

        Route::get('list', [FlightDetailController::class, 'index']);

        Route::post('add-flight', [FlightDetailController::class, 'store']);

        Route::put('update/{id}', [FlightDetailController::class, 'updatedetails']);

        Route::get('show/{id}', [FlightDetailController::class, 'show']);

        Route::delete('delete/{id}', [FlightDetailController::class, 'remove']);
    });




    Route::group(['prefix' => 'user'], function () {

        Route::put('update/{id}', [UserController::class, 'updatedetails']);

        Route::get('show/{id}', [UserController::class, 'show']);
    });




    Route::group(['prefix' => 'order'], function () {

        Route::get('{id}', [OrderController::class, 'show']);

        Route::get('{id}/orders', [OrderController::class, 'getUserOrders']);

        Route::post('{order_id}/assign/{traveler_id}', [OrderController::class, 'AssignandAcceptOrder']);

        Route::post('{order_id}/traveler/{status}', [OrderController::class, 'acceptOrRejectOrder']);

        Route::get('trip/{id}', [OrderController::class, 'getTripInfo']);

        // Route::get('history', [OrderController::class, 'OrderHistory']);

        Route::get('ongoing-trips/{userId}', [OrderController::class, 'getOngoingTrips']);

    });
    Route::get('order/history', [OrderController::class, 'OrderHistory']);



    Route::group(['prefix' => 'traveler'], function () {

        Route::get('travelers', [TravelerController::class, 'getTravelers']);

        Route::get('{id}', [TravelerController::class, 'show']);

    });


    Route::group(['prefix' => 'review'], function () {

        Route::post('submit-review', [ReviewController::class, 'submitReview']);

        Route::get('{id}', [ReviewController::class, 'show']);

    });


    Route::group(['prefix' => 'dispute'], function () {

        Route::post('submit-complaint', [DisputeController::class, 'submitComplaint']);

        Route::post('submit-response/{id}', [DisputeController::class, 'submitResponse']);

    });


    Route::group(['prefix' => 'messages'], function () {

        Route::get('{userid}', [MessageController::class, 'getUserMessages']);

        Route::post('send', [MessageController::class, 'sendMessageToSupport']);


    });

    

});