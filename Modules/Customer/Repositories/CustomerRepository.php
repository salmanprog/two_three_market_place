<?php

namespace Modules\Customer\Repositories;
use App\Traits\ImageStore;
use App\Models\Order;
use Modules\Customer\Entities\CustomerAddress;
use App\Models\User;
use App\Traits\Notification;
use App\Traits\SendMail;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Customer\Imports\CustomerImport;
use Modules\GeneralSetting\Entities\EmailTemplateType;
use Modules\GeneralSetting\Entities\NotificationSetting;
use Modules\GeneralSetting\Entities\UserNotificationSetting;
use Modules\Marketing\Entities\ReferralCode;
use Modules\Marketing\Entities\ReferralCodeSetup;
use Modules\Marketing\Entities\ReferralUse;
use Modules\OrderManage\Entities\CustomerNotification;
use Modules\Wallet\Entities\WalletBalance;
use Modules\Seller\Entities\SellerProduct;
use Modules\Seller\Entities\SellerProductSKU;
use Modules\Seller\Services\ProductService as SellerProductService;
use Modules\Product\Entities\Product;
use Modules\Product\Services\ProductService;
use App\Models\Cart;
use App\Models\OrderPackageDetail;
use Modules\Marketing\Entities\FlashDealProduct;
use Modules\Marketing\Entities\NewUserZoneProduct;
use Modules\Menu\Entities\MenuElement;
use Modules\Appearance\Entities\HeaderSliderPanel;
use Modules\FrontendCMS\Entities\HomepageCustomProduct;
use Modules\Appearance\Entities\HeaderProductPanel;
use Modules\FrontendCMS\Entities\SubsciptionPaymentInfo;
use Modules\OrderManage\Entities\OrderDeliveryState;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CustomerRepository
{
    use Notification, SendMail, ImageStore;
    public function getAll()
    {
        return User::with('wallet_balances', 'orders')->whereHas('role', function($query){
            return $query->where('type', 'customer');
        })->latest();
    }

    public function getAllInterior()
    {
        return User::with('wallet_balances', 'orders')->whereHas('role', function($query){
            return $query->where('type', 'interior_designer');
        })->latest();
    }

    public function getAllArtGallery()
    {
        return User::with('wallet_balances', 'orders')->where(function ($query) {
            $query->where('role_id', 8)
                ->orWhereHas('role', function ($q) {
                    $q->where('type', 'art_gallery');
                });
        })->latest();
    }

    public function find($id)
    {
        return User::with('wallet_balances', 'orders', 'customerAddresses')->findOrFail($id);
    }

    public function store($data){
        $field = $data['email'];
        if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
            $email = $data['email'];
        }else{
            $phone = $data['email'];
        } 
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => isset($phone) ? $phone : NULL,
            'email' => isset($email) ? $email : NULL,
            'verify_code' => sha1(time()),
            'password' => Hash::make($data['password']),
            'role_id' => 4,
            'phone' => isset($phone) ? $phone : NULL,
            'is_verified' => 1,
            'is_active' => $data['status'],
            'currency_id' => app('general_setting')->currency,
            'lang_code' => app('general_setting')->language_code,
            'currency_code' => app('general_setting')->currency_code,
        ]);

        // User Notification Setting Create
        (new UserNotificationSetting)->createForRegisterUser($user->id);
        $this->typeId = EmailTemplateType::where('type', 'register_email_template')->first()->id; //register email templete typeid
        $notification = NotificationSetting::where('slug','register')->first();
        if ($notification) {
            $this->notificationSend($notification->id, $user->id);
        }
        if (isset($data['referral_code'])) {
            $referralData = ReferralCodeSetup::first();
            $referralExist = ReferralCode::where('referral_code', $data['referral_code'])->first();
            if ($referralExist) {
                $referralExist->update(['total_used' => $referralExist->total_used + 1]);
                ReferralUse::create([
                    'user_id' => $user->id,
                    'referral_code' => $data['referral_code'],
                    'discount_amount' => $referralData->amount
                ]);
            }
        }
        return $user;

    }

    public function update($data, $id){
        $field = $data['email'];
        if (is_numeric($field)) {
            $phone = $data['email'];
        } elseif (filter_var($field, FILTER_VALIDATE_EMAIL)) {
            $email = $data['email'];
        }
        $user = User::find($id);
        $user->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => isset($phone) ? $phone : NULL,
            'email' => isset($email) ? $email : NULL,
            'password' => ($data['password'] != null)?Hash::make($data['password']):$user->password,
            'is_active' => $data['status']
        ]);
        return $user;

    }

    public function destroy($id){
        $customer = User::find($id);
        if (!$customer) {
            return false;
        }

        try {
            $this->prepareUserForAdminDelete($id);
        } catch (\Throwable $e) {
            \Log::error('prepareUserForAdminDelete failed for user '.$id.': '.$e->getMessage());
        }

        $addresses = $customer->customerAddresses->pluck('id');
        CustomerAddress::destroy($addresses);
        $notifications = CustomerNotification::where('customer_id', $id)->pluck('id');
        CustomerNotification::destroy($notifications);
        $notification_settings = UserNotificationSetting::where('user_id', $id)->pluck('id');
        UserNotificationSetting::destroy($notification_settings);
        $customer->delete();
        return true;
    }

    public function prepareUserForAdminDelete(int $userId): void
    {
        $this->deleteUserProducts($userId);
        $this->clearUserDeleteBlockers($userId);
    }

    public function deleteUserProducts(int $userId): void
    {
        if (isModuleActive('MultiVendor') && class_exists(SellerProduct::class)) {
            $sellerProductService = app(SellerProductService::class);

            SellerProduct::where('user_id', $userId)->get()->each(function ($sellerProduct) use ($sellerProductService) {
                try {
                    if ($sellerProductService->deleteById($sellerProduct->id) !== 'possible') {
                        $this->forceDeleteSellerListing($sellerProduct);
                    }
                } catch (\Throwable $e) {
                    $this->forceDeleteSellerListing($sellerProduct);
                }
            });
        }

        if (!class_exists(Product::class)) {
            return;
        }

        $productService = app(ProductService::class);

        Product::where('created_by', $userId)->get()->each(function ($product) use ($productService, $userId) {
            if (class_exists(SellerProduct::class) && SellerProduct::where('product_id', $product->id)->where('user_id', '!=', $userId)->exists()) {
                return;
            }

            try {
                if ($productService->deleteById($product->id) !== 'possible') {
                    $this->forceDeleteCatalogProduct($product->id);
                }
            } catch (\Throwable $e) {
                $this->forceDeleteCatalogProduct($product->id);
            }
        });
    }

    protected function clearUserDeleteBlockers(int $userId): void
    {
        $fallbackUserId = User::whereHas('role', function ($query) {
            $query->where('type', 'superadmin');
        })->value('id') ?? 1;

        WalletBalance::where('user_id', $userId)->delete();
        Order::where('customer_id', $userId)->update(['customer_id' => null]);
        OrderPackageDetail::where('seller_id', $userId)->update(['seller_id' => $fallbackUserId]);

        OrderDeliveryState::where('created_by', $userId)->update(['created_by' => $fallbackUserId]);

        if (Schema::hasTable('push_notifications')) {
            DB::table('push_notifications')->where('user_id', $userId)->delete();
        }

        if (Schema::hasTable('attendances')) {
            DB::table('attendances')->where('created_by', $userId)->update(['created_by' => $fallbackUserId]);
        }

        if (class_exists(SubsciptionPaymentInfo::class)) {
            SubsciptionPaymentInfo::where('seller_id', $userId)->delete();
        }

        if (class_exists(\Modules\Attendance\Entities\Event::class)) {
            $eventIds = \Modules\Attendance\Entities\Event::where('created_by', $userId)->pluck('id');
            if ($eventIds->isNotEmpty() && class_exists(\Modules\Attendance\Entities\EventBooking::class)) {
                \Modules\Attendance\Entities\EventBooking::whereIn('event_id', $eventIds)->delete();
            }
            \Modules\Attendance\Entities\Event::where('created_by', $userId)->delete();
        }
    }

    protected function forceDeleteSellerListing(SellerProduct $sellerProduct): void
    {
        $skuIds = $sellerProduct->skus->pluck('id')->toArray();

        if (!empty($skuIds)) {
            Cart::where('product_type', 'product')->whereIn('product_id', $skuIds)->delete();
        }

        FlashDealProduct::where('seller_product_id', $sellerProduct->id)->delete();
        NewUserZoneProduct::where('seller_product_id', $sellerProduct->id)->delete();
        MenuElement::where('type', 'product')->where('element_id', $sellerProduct->id)->delete();
        HeaderSliderPanel::where('data_type', 'product')->where('data_id', $sellerProduct->id)->delete();
        HomepageCustomProduct::where('seller_product_id', $sellerProduct->id)->delete();
        HeaderProductPanel::where('product_id', $sellerProduct->id)->delete();

        if ($sellerProduct->thum_img) {
            $this->deleteImage($sellerProduct->thum_img);
        }

        SellerProductSKU::where('product_id', $sellerProduct->id)->delete();
        $sellerProduct->delete();
    }

    protected function forceDeleteCatalogProduct(int $productId): void
    {
        $product = Product::find($productId);
        if (!$product) {
            return;
        }

        SellerProduct::where('product_id', $productId)->get()->each(function ($sellerProduct) {
            $this->forceDeleteSellerListing($sellerProduct);
        });

        $productService = app(ProductService::class);
        if ($productService->deleteById($productId) !== 'possible') {
            Product::where('id', $productId)->delete();
        }
    }

    public function destroyBulk(array $ids): array
    {
        $deleted = 0;
        $skipped = 0;

        foreach ($ids as $id) {
            if ($this->destroy($id) === true) {
                $deleted++;
            } else {
                $skipped++;
            }
        }

        return [
            'deleted' => $deleted,
            'skipped' => $skipped,
        ];
    }

    public function imageDelete($data){
        $customer = User::find(auth()->user()->id);
        if (showImage($customer->avatar ) == $data['image']) {
            $this->deleteImage($customer->avatar);
        }
        $customer->update([
            'avatar' => ''
        ]);
        return true;
    }
    public function BulkUploadStore($data){
        Excel::import(new CustomerImport, $data['file']->store('temp'));
    }

    public function posCustomer()
    {
        return User::with('customerAddresses')->whereHas('role', function($query){
            return $query->where(['type' => 'customer', 'is_active' => 1]);
        })->orderBy('id','DESC')->get();
    }

    public function getCustomersByAjax($search){
        if($search == ''){
            $customer = User::select('id','first_name', 'last_name')->whereHas('role', function($query){
                return $query->where(['type' => 'customer', 'is_active' => 1]);
            })->orderBy('id', 'DESC')->paginate(10);
        }else{
            $customer = User::select('id','first_name', 'last_name')
                ->where('first_name', 'LIKE', "%{$search}%")
                ->orWhere('last_name', 'LIKE', "%{$search}%")->whereHas('role', function($query){
                    return $query->where(['type' => 'customer', 'is_active' => 1]);
                })->orderBy('id', 'DESC')
                ->paginate(10);
        }
        $response = [];
        foreach($customer as $customers){
            $response[]  =[
                'id'    =>'customer-'.$customers->id,
                'text'  =>$customers->first_name.' '.$customers->last_name
            ];
        }
        return  $response;
    }

}
