<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Bkash\Http\Controllers\BkashController;
use Modules\MercadoPago\Http\Controllers\MercadoPagoController;
use Modules\PaymentGateway\Http\Controllers\StripeController;
use Modules\PaymentGateway\Http\Controllers\RazorpayController;
use Modules\PaymentGateway\Http\Controllers\PayPalController;
use Modules\PaymentGateway\Http\Controllers\PaystackController;
use Modules\PaymentGateway\Http\Controllers\PaytmController;
use Modules\PaymentGateway\Http\Controllers\InstamojoController;
use Modules\PaymentGateway\Http\Controllers\BankPaymentController;
use Modules\PaymentGateway\Http\Controllers\MidtransController;
use Modules\PaymentGateway\Http\Controllers\PayUmoneyController;
use Modules\PaymentGateway\Http\Controllers\FlutterwaveController;
use App\Models\DigitalFileDownload;
use App\Models\OrderProductDetail;
use Modules\OrderManage\Repositories\CancelReasonRepository;
use Modules\Shipping\Http\Controllers\OrderSyncWithCarrierController;
use Modules\SslCommerz\Library\SslCommerz\SslCommerzNotification;
use App\Services\OrderService;
use Modules\OrderManage\Repositories\DeliveryProcessRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Traits\OrderPdf;
use App\Traits\Otp;
use App\Traits\SendMail;
use Exception;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;
use Modules\CCAvenue\Http\Controllers\CCAvenueController;
use Modules\Clickpay\Http\Controllers\ClickpayController;
use Modules\Setup\Entities\City;
use Modules\Setup\Entities\Country;
use Modules\Setup\Entities\State;
use Modules\PaymentGateway\Http\Controllers\TabbyPaymentController;
use Modules\Seller\Entities\SellerProduct;
use Modules\Seller\Entities\SellerProductSKU;

class ResellController extends Controller
{
    public function resellProduct(Request $request){
        $products = SellerProduct::where('seller_id', auth()->user()->id)->get();
        return view('frontend.resell.product', compact('products'));
    }
}
