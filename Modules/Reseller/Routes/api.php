<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Reseller Module API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Admin API Routes
Route::prefix('admin')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::prefix('reseller')->group(function () {
        // Dashboard
        Route::get('/dashboard', 'Admin\ResellRequestController@dashboard');
        
        // Resell Requests Management
        Route::apiResource('requests', 'Admin\ResellRequestController');
        
        // Approve/Reject Requests
        Route::post('/requests/{id}/approve', 'Admin\ResellRequestController@approve');
        Route::post('/requests/{id}/reject', 'Admin\ResellRequestController@reject');
        
        // Resale Products
        Route::get('/resale-products', 'Admin\ResellRequestController@resaleProducts');
        
        // Export
        Route::get('/export', 'Admin\ResellRequestController@export');
    });
});

// Customer API Routes
Route::prefix('customer')->middleware(['auth:sanctum', 'customer'])->group(function () {
    Route::prefix('reseller')->group(function () {
        // Resell Requests
        Route::apiResource('requests', 'Customer\ResellRequestController');
        
        // Available Products
        Route::get('/available-products', 'Customer\ResellRequestController@availableProducts');
        
        // Resale Products (for purchase)
        Route::get('/resale-products', 'Customer\ResellRequestController@resaleProducts');
        
        // AJAX endpoints
        Route::get('/product-details', 'Customer\ResellRequestController@getProductDetails');
        Route::post('/calculate-profit', 'Customer\ResellRequestController@calculateProfitPreview');
    });
});

// Public API Routes
Route::prefix('resale')->group(function () {
    // Public resale products listing
    Route::get('/products', 'Customer\ResellRequestController@resaleProducts');
}); 