<?php


use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BusinessSettingsController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PremiumPlanController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\DisputeController;
use App\Http\Controllers\Admin\ReviewController;

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () 
{
    /*authentication*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', [LoginController::class, 'login'])->name('login');
        Route::post('login', [LoginController::class, 'submit']);
        
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('home-page', [LoginController::class, 'home_page'])->name('home-page');
        
    });

    Route::group(['middleware' => ['auth:admin,staff']], function () 
    {

        Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
            Route::get('list/{status}', [OrderController::class, 'list'])->name('list');
        });




    });


    Route::group(['middleware' => ['admin']], function () 
    {
        Route::get('/', [SystemController::class, 'dashboard'])->name('dashboard');




        Route::group(['prefix' => 'business-settings', 'as' => 'business-settings.'], function () {
            Route::get('store-setup', [BusinessSettingsController::class, 'store_index'])->name('store-setup');
            Route::post('update-setup', [BusinessSettingsController::class, 'store_setup'])->name('update-setup');
        });

        Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
            Route::get('list', [CustomerController::class, 'customer_list'])->name('list');
            Route::get('view/{user_id}', [CustomerController::class, 'view'])->name('view');
            Route::post('search', [CustomerController::class, 'search'])->name('search');
        });


        Route::group(['prefix' => 'premium-plans', 'as' => 'premium-plans.'], function () {
            Route::get('list', [PremiumPlanController::class, 'list'])->name('list');
            Route::get('add-new', [PremiumPlanController::class, 'add_new'])->name('add-new');
            Route::post('store', [PremiumPlanController::class, 'store'])->name('store');
            Route::get('edit/{id}', [PremiumPlanController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [PremiumPlanController::class, 'update'])->name('update');
        });




        Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
            Route::get('list/{status}', [OrderController::class, 'list'])->name('list');
            Route::get('details/{id}', [OrderController::class, 'details'])->name('details');
            Route::get('status', [OrderController::class, 'UpdateOrderStatus'])->name('status');
            Route::get('payment-status', [OrderController::class, 'payment_status'])->name('payment-status');
            Route::delete('delete-order/{id}', [OrderController::class, 'delete_order'])->name('delete-order');
            Route::post('search', [OrderController::class, 'search'])->name('search');
        });


        Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {
            Route::get('list', [BannerController::class, 'list'])->name('list');
            Route::get('add-new', [BannerController::class, 'Addnew'])->name('add-new');
            Route::post('store', [BannerController::class, 'store'])->name('store');
            Route::get('edit/{id}', [BannerController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [BannerController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [BannerController::class, 'delete'])->name('delete');
        });

        Route::group(['prefix' => 'subscription', 'as' => 'subscription.'], function () {
            Route::get('list', [SubscriptionController::class, 'list'])->name('list');
            Route::get('add-new', [SubscriptionController::class, 'Addnew'])->name('add-new');
            Route::post('put', [SubscriptionController::class, 'Add'])->name('put');
            Route::get('edit/{id}', [SubscriptionController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [SubscriptionController::class, 'Modify'])->name('update');
            Route::delete('delete/{id}', [SubscriptionController::class, 'delete'])->name('delete');
        });


        Route::group(['prefix' => 'dispute', 'as' => 'dispute.'], function () {
            Route::get('list', [DisputeController::class, 'list'])->name('list');
            Route::get('add-new', [DisputeController::class, 'Addnew'])->name('add-new');
            Route::post('put', [DisputeController::class, 'Add'])->name('put');
            Route::get('edit/{id}', [DisputeController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [DisputeController::class, 'Modify'])->name('update');
            Route::delete('delete/{id}', [DisputeController::class, 'delete'])->name('delete');
        });


        Route::group(['prefix' => 'review', 'as' => 'review.'], function () {
            Route::get('list', [ReviewController::class, 'list'])->name('list');
        });



    });
  
});
