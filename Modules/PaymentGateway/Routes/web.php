<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::prefix('paymentgateway')->middleware(['auth'])->group(function() {
    Route::get('/', 'PaymentGatewayController@index')->name('payment_gateway.index')->middleware(['seller','permission']);
    Route::post('/configuration', 'PaymentGatewayController@configuration')->name('payment_gateway.configuration')->middleware(['seller','prohibited_demo_mode']);
    Route::post('/payment-gateway-activation', 'PaymentGatewayController@activation')->name('update_payment_activation_status')->middleware(['permission','prohibited_demo_mode']);

    // setting
    Route::get('/setting', 'PaymentGatewaySettingController@index')->name('payment_gateway.setting')->middleware(['admin']);
    Route::post('/setting/activation', 'PaymentGatewaySettingController@activation')->name('setting_payment_activation_status')->middleware(['admin','permission','prohibited_demo_mode']);
    Route::post('/setting/update', 'PaymentGatewaySettingController@update')->name('paymentgateway.setting_update')->middleware(['admin','permission','prohibited_demo_mode']);

});
Route::post('paypal-payment', 'PayPalController@payment')->name('paypal.payment');
Route::get('paypal-cancel', 'PayPalController@paypalFailed')->name('paypal.paypalFailed');
Route::get('paypal-payment/success', 'PayPalController@paypalSuccess')->name('paypal.paypalSuccess');
Route::get('stripe-payment', 'StripeController@payment_page')->name('stripe.payment_create');
Route::post('stripe-payment-store', 'StripeController@stripePost')->name('stripe.payment');
Route::post('stripe-webhook', 'StripeController@webhook')->name('stripe.webhook')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::get('pay-with-razorpay', 'RazorpayController@payWithRazorpay')->name('paywithrazorpay');
Route::post('razorpay-payment', 'RazorpayController@payment')->name('razorpay.payment');
Route::post('/paystack-payment', 'PaystackController@redirectToGateway')->name('paystack.payment');
Route::get('/paystack-redirect', 'PaystackController@handleGatewayCallback')->name('paystack.payment_redirect');
Route::post('/paytm-payment/status', 'PaytmController@paymentCallback')->name('paytm.payment_redirect_callback');
Route::get('/instamojo-payment/status', 'InstamojoController@paymentSuccess')->name('instamojo.payment_success');
Route::post('/midtrans-payment-success', 'MidtransController@paymentSuccess')->name('midtrans.payment_success');
Route::post('/midtrans-payment-failed', 'MidtransController@paymentFailed')->name('midtrans.payment_failed');
Route::post('/payumoney-payment-success', 'PayUmoneyController@success')->name('payumoney.success');
Route::post('/payumoney-payment-failed', 'PayUmoneyController@failed')->name('payumoney.failed');
Route::post('/jazzcash-payment-status', 'JazzCashController@paymentStatus')->name('jazzcash.payment_status');
Route::post('/googlePay-payment-status', 'GooglePayController@paymentStatus')->name('googlePay.payment_status');

Route::post('/flutterwave-pay', 'FlutterwaveController@payment')->name('flatterwave.payment');
Route::get('/flutterwave/callback', 'FlutterwaveController@callback')->name('flatterwave.callback');

