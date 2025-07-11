<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Reseller Module Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::prefix('reseller')->group(function () {
        // Dashboard
        Route::get('/dashboard', 'Admin\ResellRequestController@dashboard')->name('admin.reseller.dashboard');
        
        // Resell Requests Management
        Route::get('/requests', 'Admin\ResellRequestController@index')->name('admin.resell-requests.index');
        Route::get('/requests/create', 'Admin\ResellRequestController@create')->name('admin.resell-requests.create');
        Route::post('/requests', 'Admin\ResellRequestController@store')->name('admin.resell-requests.store');
        Route::get('/requests/{id}', 'Admin\ResellRequestController@show')->name('admin.resell-requests.show');
        Route::get('/requests/{id}/edit', 'Admin\ResellRequestController@edit')->name('admin.resell-requests.edit');
        Route::put('/requests/{id}', 'Admin\ResellRequestController@update')->name('admin.resell-requests.update');
        Route::delete('/requests/{id}', 'Admin\ResellRequestController@destroy')->name('admin.resell-requests.destroy');
        
        // Approve/Reject Requests
        Route::post('/requests/{id}/approve', 'Admin\ResellRequestController@approve')->name('admin.resell-requests.approve');
        Route::post('/requests/{id}/reject', 'Admin\ResellRequestController@reject')->name('admin.resell-requests.reject');
        
        // Resale Products
        Route::get('/resale-products', 'Admin\ResellRequestController@resaleProducts')->name('admin.resale-products.index');
        
        // Export
        Route::get('/export', 'Admin\ResellRequestController@export')->name('admin.resell-requests.export');
    });
});

// Customer Routes
Route::prefix('customer')->middleware(['auth', 'customer'])->group(function () {
    Route::prefix('reseller')->group(function () {
        // Resell Requests
        Route::get('/requests', 'Customer\ResellRequestController@index')->name('customer.resell-requests.index');
        Route::get('/requests/create', 'Customer\ResellRequestController@create')->name('customer.resell-requests.create');
        Route::post('/requests', 'Customer\ResellRequestController@store')->name('customer.resell-requests.store');
        Route::get('/requests/{id}', 'Customer\ResellRequestController@show')->name('customer.resell-requests.show');
        Route::get('/requests/{id}/edit', 'Customer\ResellRequestController@edit')->name('customer.resell-requests.edit');
        Route::put('/requests/{id}', 'Customer\ResellRequestController@update')->name('customer.resell-requests.update');
        Route::delete('/requests/{id}', 'Customer\ResellRequestController@destroy')->name('customer.resell-requests.destroy');
        
        // Available Products
        Route::get('/available-products', 'Customer\ResellRequestController@availableProducts')->name('customer.available-products.index');
        
        // Resale Products (for purchase)
        Route::get('/resale-products', 'Customer\ResellRequestController@resaleProducts')->name('customer.resale-products.index');
        
        // AJAX endpoints
        Route::get('/product-details', 'Customer\ResellRequestController@getProductDetails')->name('customer.product-details');
        Route::post('/calculate-profit', 'Customer\ResellRequestController@calculateProfitPreview')->name('customer.calculate-profit');
    });
});

// Public Routes
Route::prefix('resale')->group(function () {
    // Public resale products listing
    Route::get('/products', 'Customer\ResellRequestController@resaleProducts')->name('resale.products.index');
}); 