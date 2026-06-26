<?php

namespace App\Traits;

use App\Jobs\SendmailJob;
use App\Mail\SendQueueMail;
use Illuminate\Support\Facades\Mail;
use Modules\GeneralSetting\Entities\EmailTemplate;
use App\Mail\TestSmptMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\GeneralSetting\Entities\EmailTemplateType;
use Modules\UserActivityLog\Traits\LogActivity;
use PDF;

trait SendMail
{

    public function sendNotificationByMail($typeId, $user, $notificationSetting, $relatable_id = null, $relatable_type = null, $order_tracking_number = null)
    {
        $email_template = EmailTemplate::where('type_id', $typeId)
            ->where('is_active', 1)
            ->when($relatable_id, function ($query) use ($relatable_id, $relatable_type) {
                $query->where('relatable_id', $relatable_id)->where('relatable_type', $relatable_type);
            })
            ->first();
        if ($email_template) {
            try {
                if (app('general_setting')->mail_protocol == "smtp") {
                    $datas = $this->mailData($email_template, $user->first_name, $user->email, $order_tracking_number, $notificationSetting->message);
                    Mail::to($user->email)->queue(new SendQueueMail($datas));
                    return true;
                } elseif (app('general_setting')->mail_protocol == "sendmail") {
                    $datas = $this->mailData($email_template, $user->first_name, $user->email, $order_tracking_number, $notificationSetting->message);
                    $message = (string) view('emails.mail', $datas);
                    $this->phpMailData($user->email, $email_template->subject, $message);

                    if(config('queue.default') == 'sync'){
                        return $this->phpMailData($user->email, $email_template->subject, $message);
                    }else{
                        dispatch(new SendmailJob($user->email, $email_template->subject, $message));
                        return true;
                    }
                    return true;
                } else {
                    return false;
                }
            } catch (\Exception $e) {
                LogActivity::errorLog($e->getMessage());
            }
        }
    }
    public function sendContactEmail($typeId, $content)
    {
        try {
            $email_template = EmailTemplate::where('type_id', $typeId)
                ->where('is_active', 1)
                ->first();

            $body = $email_template->body;
            foreach ($content as $key => $value) {
                $body = str_replace('{{ ' . $key . ' }}', $value, $body);
            }
            
            $toEmail = env('MAIL_RECIEVER_ADDRESS');
            $protocol = app('general_setting')->mail_protocol ?? 'smtp';

            if ($protocol === 'smtp') {
                $datas = $this->contactMailData($email_template, $content['first_name'], $content['email'], $content['phone'], $content['service'], $content['message']);
                Mail::to($toEmail)->queue(new SendQueueMail($datas));
                return true;
            } elseif ($protocol === 'sendmail') {
                $message = (string) view('emails.mail', compact('data'));

                if (config('queue.default') === 'sync') {
                    $this->phpMailData($toEmail, $data['subject'], $message);
                } else {
                    dispatch(new SendmailJob($toEmail, $data['subject'], $message));
                }
            } else {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return false;
        }
    }

    public function sendOtpByMail($user, $otp)
    {

        $email_template = EmailTemplate::where('type_id', 35)->where('is_active', 1)->first();
        $email = $user->customer_email;
        if ($email_template) {

            try {
                if (app('general_setting')->mail_protocol == "smtp") {
                     $datas = $this->otpMailData($email_template, $user->name, $email, $otp);
                    Mail::to($user->email)->queue(new SendQueueMail($datas));
                    return true;
                } elseif (app('general_setting')->mail_protocol == "sendmail") {
                    $datas = $this->otpMailData($email_template, $user->first_name, $user->email, $otp);
                    $message = (string) view('emails.mail', $datas);
                    if(config('queue.default') == 'sync'){
                        return $this->phpMailData($user->email, $email_template->subject, $message);
                    }else{
                        dispatch(new SendmailJob($user->email, $email_template->subject, $message));
                        return true;
                    }
                } else {
                    return false;
                }
            } catch (\Exception $e) {
                LogActivity::errorLog($e->getMessage());
                return false;
            }
        }
        return false;
    }
    public function sendLoginOtpByMail($user, $otp)
    {
        $email_template = EmailTemplate::where('type_id', 37)->where('is_active', 1)->first();
        if ($email_template) {
            try {

                if (app('general_setting')->mail_protocol == "smtp") {
                    $datas = $this->otpMailData($email_template, $user->first_name, $user->email, $otp);
                    Mail::to($user->email)->queue(new SendQueueMail($datas));
                    return true;
                } elseif (app('general_setting')->mail_protocol == "sendmail") {
                    $datas = $this->otpMailData($email_template, $user->first_name, $user->email, $otp);
                    $message = (string) view('emails.mail', $datas);
                    if(config('queue.default') == 'sync'){
                        return $this->phpMailData($user->email, $email_template->subject, $message);
                    }else{
                        dispatch(new SendmailJob($user->email, $email_template->subject, $message));
                        return true;
                    }
                } else {
                    return false;
                }
            } catch (\Exception $e) {
                LogActivity::errorLog($e->getMessage());
                return false;
            }
        }
        return false;
    }
    public function sendPasswordResetOtpByMail($user, $otp)
    {
        $email_template = EmailTemplate::where('type_id', 38)->where('is_active', 1)->first();
        if ($email_template) {
            try {
                if (app('general_setting')->mail_protocol == "smtp") {
                    $datas = $this->otpMailData($email_template, $user->first_name, $user->email, $otp);
                    Mail::to($user->email)->queue(new SendQueueMail($datas));
                    return true;
                } elseif (app('general_setting')->mail_protocol == "sendmail") {
                    $datas = $this->otpMailData($email_template, $user->first_name, $user->email, $otp);
                    $message = (string) view('emails.mail', $datas);
                    if(config('queue.default') == 'sync'){
                        return $this->phpMailData($user->email, $email_template->subject, $message);
                    }else{
                        dispatch(new SendmailJob($user->email, $email_template->subject, $message));
                        return true;
                    }
                } else {
                    return false;
                }
            } catch (\Exception $e) {
                LogActivity::errorLog($e->getMessage());
                return false;
            }
        }
        return false;
    }
    public function sendOtpByMailForSeller($user, $otp)
    {
        $email_template = EmailTemplate::where('type_id', 35)->where('is_active', 1)->first();
        if ($email_template) {
            try {
                if (app('general_setting')->mail_protocol == "smtp") {
                    $datas = $this->otpMailData($email_template, $user->name, $user->email, $otp);
                    Mail::to($user->email)->queue(new SendQueueMail($datas));
                    return true;
                } elseif (app('general_setting')->mail_protocol == "sendmail") {
                    $datas = $this->otpMailData($email_template, $user->name, $user->email, $otp);
                    $message = (string) view('emails.mail', $datas);
                    if(config('queue.default') == 'sync'){
                        return $this->phpMailData($user->email, $email_template->subject, $message);
                    }else{
                        dispatch(new SendmailJob($user->email, $email_template->subject, $message));
                        return true;
                    }
                } else {
                    return false;
                }
            } catch (\Exception $e) {
                LogActivity::errorLog($e->getMessage());
                return false;
            }
        }
        return false;
    }
    public function sendOtpByMailForOrder($user, $otp)
    {
        $email_template = EmailTemplate::where('type_id', 36)->where('is_active', 1)->first();
        $email = $user->customer_email;
        if ($email_template) {
            try {
                if (app('general_setting')->mail_protocol == "smtp") {
                    $datas = $this->mailData($email_template, $user->name, $email, $otp);
                    Mail::to($user->email)->queue(new SendQueueMail($datas));
                    return true;
                } elseif (app('general_setting')->mail_protocol == "sendmail") {
                    $datas = $this->mailData($email_template, $user->name, $email, $otp);
                    $message = (string) view('emails.mail', $datas);
                    if(config('queue.default') == 'sync'){
                        return $this->phpMailData($email, $email_template->subject, $message);
                    }else{
                        dispatch(new SendmailJob($email, $email_template->subject, $message));
                        return true;
                    }
                } else {
                    return false;
                }
            } catch (\Exception $e) {
                LogActivity::errorLog($e->getMessage());
                return false;
            }
        }
        return false;
    }
    public function sendSupportTicketMail($user, $supportTicketMessage)
    {
        $email_template = EmailTemplate::where('type_id', 22)->where('is_active', 1)->first();
        if ($email_template) {
            try {

                if (app('general_setting')->mail_protocol == "smtp") {
                    $datas = $this->mailData($email_template, $user->first_name, $user->email, $supportTicketMessage);
                    Mail::to($user->email)->queue(new SendQueueMail($datas));
                    return true;
                } elseif (app('general_setting')->mail_protocol == "sendmail") {
                    $datas = $this->mailData($email_template, $user->first_name, $user->email, $supportTicketMessage);
                    $message = (string) view('emails.mail', $datas);
                    if(config('queue.default') == 'sync'){
                        return $this->phpMailData($user->email, $email_template->subject, $message);
                    }else{
                        dispatch(new SendmailJob($user->email, $email_template->subject, $message));
                        return true;
                    }
                } else {
                    return false;
                }
            } catch (\Exception $e) {
                LogActivity::errorLog($e->getMessage());
            }
        }
    }
    public function sendVerificationMail($user, $supportTicketMessage)
    {
        $email_template = EmailTemplate::where('type_id', 23)->where('is_active', 1)->first();
        if ($email_template) {
            try {
                if (app('general_setting')->mail_protocol == "smtp") {
                    $datas = $this->mailData($email_template, $user->first_name, $user->email, null, null, null, $supportTicketMessage);
                    Mail::to($user->email)->queue(new SendQueueMail($datas));
                    return true;
                } elseif (app('general_setting')->mail_protocol == "sendmail") {
                    $datas = $this->mailData($email_template, $user->first_name, $user->email, null, null, null, $supportTicketMessage);
                    $message = (string) view('emails.mail', $datas);
                    if(config('queue.default') == 'sync'){
                        return $this->phpMailData($user->email, $email_template->subject, $message);
                    }else{
                        dispatch(new SendmailJob($user->email, $email_template->subject, $message));
                        return true;
                    }
                } else {
                    return false;
                }
            } catch (\Exception $e) {
                LogActivity::errorLog($e->getMessage());
            }
        }
    }

    public function sendSellerVerificationMail($user, $supportTicketMessage)
    {
        $email_template = EmailTemplate::where('type_id', 39)->where('is_active', 1)->first();
        if ($email_template) {
            try {
                if (app('general_setting')->mail_protocol == "smtp") {
                    $datas = $this->mailData($email_template, $user->first_name, $user->email, null, null, null, $supportTicketMessage);
                    Mail::to($user->email)->queue(new SendQueueMail($datas));
                    return true;
                } elseif (app('general_setting')->mail_protocol == "sendmail") {
                    $datas = $this->mailData($email_template, $user->first_name, $user->email, null, null, null, $supportTicketMessage);
                    $message = (string) view('emails.mail', $datas);
                    if(config('queue.default') == 'sync'){
                        return $this->phpMailData($user->email, $email_template->subject, $message);
                    }else{
                        dispatch(new SendmailJob($user->email, $email_template->subject, $message));
                        return true;
                    }
                } else {
                    return false;
                }
            } catch (\Exception $e) {
                LogActivity::errorLog($e->getMessage());
            }
        }
    }

    function sendMailWithTemplate($to, $array, $mailPath, $template)
    {
        try {
            $general_setting = DB::table('general_settings')->select('mail_protocol','email')->first();
            if ($general_setting->mail_protocol == "smtp") {
                Mail::to($to)->queue(new $mailPath($array));
            } elseif ($general_setting->mail_protocol == "sendmail") {
                $message = (string) view($template, compact('array'));
                if(config('queue.default') == 'sync'){
                    return $this->phpMailData($to, $array['subject'], $message);
                }else{
                    dispatch(new SendmailJob($to, $array['subject'], $message));
                    return true;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
        }
    }

    public function sendMailTest($to, $subject, $body)
    {

        try {
            if (app('general_setting')->mail_protocol == "smtp") {
                $attribute = [
                    'from' => env('MAIL_FROM_ADDRESS'),
                    'subject' => $subject,
                    'content' => $body
                ];

                Mail::to($to)->queue(new TestSmptMail($attribute));
                return true;
            } elseif (app('general_setting')->mail_protocol == "sendmail") {
                $datas = [
                    'from' => env('MAIL_FROM_ADDRESS'),
                    'subject' => $subject,
                    'body' => $body
                ];
                $message = (string) view("emails.mail", $datas);
                if(config('queue.default') == 'sync'){
                    return $this->phpMailData($to, $subject, $message);
                }else{
                    dispatch(new SendmailJob($to, $subject, $message));
                    return true;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return 'failed';
        }
    }

    function sendInvoiceMail($order_number, $order)
    {
        try {
            $email_template = EmailTemplate::where('type_id', 1)->where('is_active', 1)->first();
            if ($email_template && $email_template->is_active == 1) {
                if (app('general_setting')->mail_protocol == "smtp") {
                    $path = public_path('/invoice/order-'.$order->id.'.pdf');
                    $pdf = PDF::loadView(theme('pages.profile.order_pdf'), compact('order'))->save($path);
                    if (in_array("customer", json_decode($email_template->reciepnt_type))) {
                        if ($order->customer_id) {
                            $datas = $this->mailInvoiceData($email_template, $order->customer->first_name, $order->customer_email, $order);
                            $datas['attach'] = $path;
                            Mail::to($order->customer_email)->queue(new SendQueueMail($datas));
                        } else {
                            $datas = $this->mailInvoiceData($email_template, $order->guest_info->billing_name, $order->guest_info->billing_email, $order);
                            $datas['attach'] = $path;
                            Mail::to($order->guest_info->billing_email)->queue(new SendQueueMail($datas));
                        }
                    }
                    if (in_array("admin", json_decode($email_template->reciepnt_type))) {
                        foreach ($order->packages as $key => $package) {
                            if ($package->seller->email) {
                                $datas = $this->mailData($email_template, $package->seller->first_name, $package->seller->email, $package->package_code);
                                $datas['attach'] = $path;
                                Mail::to($package->seller->email)->queue(new SendQueueMail($datas));
                            }
                        }
                    }
                    if (in_array("seller", json_decode($email_template->reciepnt_type))) {
                        foreach ($order->packages as $key => $package) {
                            if ($package->seller->email) {
                                $datas = $this->mailData($email_template, $package->seller->first_name, $package->seller->email, $package->package_code);
                                $datas['attach'] = $path;
                                Mail::to($package->seller->email)->queue(new SendQueueMail($datas));
                            }
                        }
                    }
                    return true;
                } elseif (app('general_setting')->mail_protocol == "sendmail") {
                    $datas = $this->mailData($email_template, $order->customer->first_name, $order->customer_email, $order->order_number);
                    $message = (string) view('emails.mail', $datas);
                    if(config('queue.default') == 'sync'){
                        return $this->phpMailData($order->customer_email, $email_template->subject, $message);
                    }else{
                        dispatch(new SendmailJob($order->customer_email, $email_template->subject, $message));
                        return true;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
        }
    }

    public function sendOrderPlacedCustomerMail($order, ?string $newAccountPassword = null)
    {
        if (empty($order->customer_email)) {
            return false;
        }

        $order->loadMissing([
            'customer',
            'address',
            'packages.products.seller_product_sku.product',
            'packages.products.seller_product_sku.sku.product',
            'guest_info',
        ]);

        $typeId = EmailTemplateType::where('type', 'order_invoice_template')->value('id');

        $email_template = $typeId
            ? EmailTemplate::where('type_id', $typeId)->where('is_active', 1)->first()
            : null;

        if (! $email_template) {
            return false;
        }

        $customerName = $order->customer
            ? $order->customer->first_name
            : ($order->guest_info->billing_name ?? 'Customer');

        try {
            if (app('general_setting')->mail_protocol == 'smtp') {
                $datas = $this->orderConfirmationMailData($email_template, $customerName, $order, $newAccountPassword);

                try {
                    $invoiceDir = public_path('invoice');
                    if (! is_dir($invoiceDir)) {
                        mkdir($invoiceDir, 0755, true);
                    }

                    $path = public_path('/invoice/order-'.$order->id.'.pdf');
                    PDF::loadView(theme('pages.profile.order_pdf'), compact('order'))->save($path);
                    $datas['attach'] = $path;
                } catch (\Exception $pdfException) {
                    LogActivity::errorLog('Order invoice PDF failed: '.$pdfException->getMessage());
                }

                Mail::to($order->customer_email)->queue(new SendQueueMail($datas));

                return true;
            }

            if (app('general_setting')->mail_protocol == 'sendmail') {
                $datas = $this->orderConfirmationMailData($email_template, $customerName, $order, $newAccountPassword);
                $message = (string) view('emails.mail', $datas);

                if (config('queue.default') == 'sync') {
                    return $this->phpMailData($order->customer_email, $email_template->subject, $message);
                }

                dispatch(new SendmailJob($order->customer_email, $email_template->subject, $message));

                return true;
            }
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
        }

        return false;
    }

    public function sendOrderPlacedSellerMails($order): void
    {
        $order->loadMissing([
            'customer',
            'guest_info',
            'packages.seller.role',
            'packages.products.seller_product_sku.product',
            'packages.products.seller_product_sku.sku.product',
        ]);

        $typeId = EmailTemplateType::where('type', 'seller_new_order_template')->value('id');
        $email_template = $typeId
            ? EmailTemplate::where('type_id', $typeId)->where('is_active', 1)->first()
            : null;

        if (! $email_template) {
            return;
        }

        $customerName = $order->customer
            ? trim($order->customer->first_name.' '.($order->customer->last_name ?? ''))
            : ($order->guest_info->billing_name ?? $order->customer_email ?? 'Customer');

        $customerEmail = $order->customer_email ?: ($order->guest_info->billing_email ?? '');

        foreach ($order->packages as $package) {
            $seller = $package->seller;
            if (! $seller || empty($seller->email) || ($seller->role->type ?? null) !== 'seller') {
                continue;
            }

            try {
                $datas = $this->sellerNewOrderMailData(
                    $email_template,
                    $seller,
                    $order,
                    $package,
                    $customerName,
                    $customerEmail
                );

                if (app('general_setting')->mail_protocol == 'smtp') {
                    Mail::to($seller->email)->queue(new SendQueueMail($datas));
                } elseif (app('general_setting')->mail_protocol == 'sendmail') {
                    $message = (string) view('emails.mail', $datas);

                    if (config('queue.default') == 'sync') {
                        $this->phpMailData($seller->email, $datas['title'], $message);
                    } else {
                        dispatch(new SendmailJob($seller->email, $datas['title'], $message));
                    }
                }
            } catch (\Exception $e) {
                LogActivity::errorLog('Seller new order email failed: '.$e->getMessage());
            }
        }
    }

    protected function buildPackageItemsSummaryHtml($package): string
    {
        $rows = '';

        foreach ($package->products as $item) {
            $productName = @$item->seller_product_sku->product->product_name
                ?? @$item->seller_product_sku->sku->product->product_name
                ?? (@$item->giftCard->name ?: 'Product');

            $rows .= '<tr>'
                .'<td style="padding:10px 12px;border-bottom:1px solid #eeeeee;font-size:14px;color:#333333;">'.e($productName).'</td>'
                .'<td style="padding:10px 12px;border-bottom:1px solid #eeeeee;font-size:14px;color:#333333;text-align:center;">'.e((string) $item->qty).'</td>'
                .'<td style="padding:10px 12px;border-bottom:1px solid #eeeeee;font-size:14px;color:#333333;text-align:right;">'.e(single_price($item->total_price ?? ($item->price * $item->qty))).'</td>'
                .'</tr>';
        }

        if ($rows === '') {
            return '<p style="margin:0;font-size:14px;color:#666666;">No items found for this package.</p>';
        }

        return '<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border:1px solid #eeeeee;border-radius:6px;overflow:hidden;margin-bottom:8px;">'
            .'<tr style="background-color:#f3f3f3;">'
            .'<th style="padding:10px 12px;font-size:13px;color:#333333;text-align:left;">Item</th>'
            .'<th style="padding:10px 12px;font-size:13px;color:#333333;text-align:center;">Qty</th>'
            .'<th style="padding:10px 12px;font-size:13px;color:#333333;text-align:right;">Total</th>'
            .'</tr>'
            .$rows
            .'</table>';
    }

    protected function packageTotalAmount($package): float
    {
        $itemsTotal = $package->products->sum(function ($item) {
            return (float) ($item->total_price ?? ($item->price * $item->qty));
        });

        return $itemsTotal + (float) ($package->shipping_cost ?? 0) + (float) ($package->tax_amount ?? 0);
    }

    public function sellerNewOrderMailData($email_template, $seller, $order, $package, $customerName, $customerEmail): array
    {
        $siteUrl = app('general_setting')->website_url
            ?: (app()->runningInConsole() ? config('app.url') : url('/'))
            ?: config('app.url')
            ?: env('APP_URL')
            ?: url('/');

        $siteUrl = rtrim((string) $siteUrl, '/');
        $orderLink = url(route('order_manage.show_details_mine', encrypt($package->id), false));

        $subject = str_replace(
            ['{ORDER_NUMBER}', '{PACKAGE_CODE}'],
            [$order->order_number, $package->package_code],
            $email_template->subject
        );

        $datas = [
            'email' => app('general_setting')->email,
            'title' => $subject,
            'from' => env('MAIL_FROM_ADDRESS'),
            'body' => $email_template->value,
        ];

        $replacements = [
            '{USER_FIRST_NAME}' => $seller->first_name,
            '{USER_EMAIL}' => $seller->email,
            '{APP_NAME}' => app('general_setting')->site_title ?: config('app.name'),
            '{SITE_URL}' => $siteUrl,
            '{EMAIL_SIGNATURE}' => app('general_setting')->mail_signature,
            '{ORDER_NUMBER}' => $order->order_number,
            '{PACKAGE_CODE}' => $package->package_code,
            '{ORDER_TOTAL}' => single_price($this->packageTotalAmount($package)),
            '{ORDER_DATE}' => $order->created_at ? $order->created_at->format('M d, Y') : now()->format('M d, Y'),
            '{ORDER_ITEMS}' => $this->buildPackageItemsSummaryHtml($package),
            '{ORDER_LINK}' => $orderLink,
            '{CUSTOMER_NAME}' => $customerName,
            '{CUSTOMER_EMAIL}' => $customerEmail,
            '{WEBSITE_NAME}' => app('general_setting')->site_title,
            '{EMAIL_FOOTER}' => $email_template->footer ?? '',
        ];

        foreach ($replacements as $placeholder => $value) {
            $datas['body'] = str_replace($placeholder, (string) $value, $datas['body']);
        }

        return $datas;
    }

    protected function buildOrderItemsSummaryHtml($order): string
    {
        $rows = '';

        foreach ($order->packages as $package) {
            foreach ($package->products as $item) {
                $productName = @$item->seller_product_sku->product->product_name
                    ?? @$item->seller_product_sku->sku->product->product_name
                    ?? 'Product';

                $rows .= '<tr>'
                    .'<td style="padding:10px 12px;border-bottom:1px solid #eeeeee;font-size:14px;color:#333333;">'.e($productName).'</td>'
                    .'<td style="padding:10px 12px;border-bottom:1px solid #eeeeee;font-size:14px;color:#333333;text-align:center;">'.e((string) $item->qty).'</td>'
                    .'<td style="padding:10px 12px;border-bottom:1px solid #eeeeee;font-size:14px;color:#333333;text-align:right;">'.e(single_price($item->price * $item->qty)).'</td>'
                    .'</tr>';
            }
        }

        if ($rows === '') {
            return '<p style="margin:0;font-size:14px;color:#666666;">No items found for this order.</p>';
        }

        return '<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border:1px solid #eeeeee;border-radius:6px;overflow:hidden;margin-bottom:8px;">'
            .'<tr style="background-color:#f3f3f3;">'
            .'<th style="padding:10px 12px;font-size:13px;color:#333333;text-align:left;">Item</th>'
            .'<th style="padding:10px 12px;font-size:13px;color:#333333;text-align:center;">Qty</th>'
            .'<th style="padding:10px 12px;font-size:13px;color:#333333;text-align:right;">Total</th>'
            .'</tr>'
            .$rows
            .'</table>';
    }

    protected function buildNewAccountCredentialsHtml(?string $email, ?string $plainPassword): string
    {
        if (empty($email) || empty($plainPassword)) {
            return '';
        }

        $loginUrl = url(route('login', [], false));

        return '<p style="margin:24px 0 12px;font-size:15px;color:#333333;font-weight:600;">Your Account Login Details</p>'
            .'<p style="margin:0 0 16px;font-size:14px;color:#555555;line-height:1.7;">We created an account for you so you can sign in and track your order status on our platform.</p>'
            .'<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#f9f9f9;border:1px solid #eeeeee;border-radius:6px;margin-bottom:16px;">'
            .'<tr><td style="padding:16px 20px;">'
            .'<p style="margin:0 0 8px;font-size:14px;color:#333333;line-height:1.6;"><strong>Email:</strong> '.e($email).'</p>'
            .'<p style="margin:0;font-size:14px;color:#333333;line-height:1.6;"><strong>Password:</strong> '.e($plainPassword).'</p>'
            .'</td></tr></table>'
            .'<p style="margin:0 0 16px;font-size:13px;color:#666666;line-height:1.6;">Please change your password after your first login.</p>'
            .'<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:0 auto 8px;">'
            .'<tr><td style="background-color:#000000;border-radius:5px;">'
            .'<a href="'.e($loginUrl).'" target="_blank" style="display:inline-block;padding:12px 28px;font-size:14px;font-weight:600;color:#ffffff;text-decoration:none;">Sign In to Your Account</a>'
            .'</td></tr></table>';
    }

    public function orderConfirmationMailData($email_template, $to_name, $order, ?string $newAccountPassword = null): array
    {
        $siteUrl = app('general_setting')->website_url
            ?: (app()->runningInConsole() ? config('app.url') : url('/'))
            ?: config('app.url')
            ?: env('APP_URL')
            ?: url('/');

        $siteUrl = rtrim((string) $siteUrl, '/');
        $orderLink = url(route('frontend.my_purchase_order_detail', encrypt($order->id), false));

        $datas = [
            'email' => app('general_setting')->email,
            'title' => $email_template->subject,
            'from' => env('MAIL_FROM_ADDRESS'),
            'body' => $email_template->value,
        ];

        $replacements = [
            '{USER_FIRST_NAME}' => $to_name,
            '{USER_EMAIL}' => $order->customer_email,
            '{APP_NAME}' => app('general_setting')->site_title ?: config('app.name'),
            '{SITE_URL}' => $siteUrl,
            '{EMAIL_SIGNATURE}' => app('general_setting')->mail_signature,
            '{ORDER_NUMBER}' => $order->order_number,
            '{ORDER_TRACKING_NUMBER}' => $order->order_number,
            '{ORDER_TOTAL}' => single_price($order->grand_total),
            '{ORDER_DATE}' => $order->created_at ? $order->created_at->format('M d, Y') : now()->format('M d, Y'),
            '{ORDER_ITEMS}' => $this->buildOrderItemsSummaryHtml($order),
            '{ORDER_LINK}' => $orderLink,
            '{LOGIN_URL}' => url(route('login', [], false)),
            '{ACCOUNT_CREDENTIALS}' => $this->buildNewAccountCredentialsHtml($order->customer_email, $newAccountPassword),
            '{WEBSITE_NAME}' => app('general_setting')->site_title,
            '{EMAIL_FOOTER}' => $email_template->footer ?? '',
        ];

        foreach ($replacements as $placeholder => $value) {
            $datas['body'] = str_replace($placeholder, (string) $value, $datas['body']);
        }

        return $datas;
    }

    function sendOrderRefundInfoUpdateMail($order, $type_id)
    {
        try {
            $email_template = EmailTemplate::where('type_id', $type_id)->where('is_active', 1)->first();
            if ($email_template && $email_template->is_active == 1) {
                if (app('general_setting')->mail_protocol == "smtp") {
                    if (in_array("customer", json_decode($email_template->reciepnt_type))) {
                        if ($order->customer_id) {
                            $datas = $this->mailData($email_template, $order->customer->first_name, $order->customer_email, $order->order_number);
                            Mail::to($order->customer_email)->queue(new SendQueueMail($datas));
                        } else {
                            $datas = $this->mailData($email_template, $order->guest_info->billing_name, $order->guest_info->billing_email, $order->order_number);
                            Mail::to($order->guest_info->billing_email)->queue(new SendQueueMail($datas));
                        }
                    }
                    if (in_array("seller", json_decode($email_template->reciepnt_type))) {
                        foreach ($order->packages as $key => $package) {
                            if ($package->seller->email) {
                                $datas = $this->mailData($email_template, $package->seller->first_name, $package->seller->email, $package->package_code);
                                Mail::to($package->seller->email)->queue(new SendQueueMail($datas));
                            }
                        }
                    }
                    return true;
                } elseif (app('general_setting')->mail_protocol == "sendmail") {
                    if (in_array("customer", json_decode($email_template->reciepnt_type))) {
                        if ($order->customer_id) {
                            $datas = $this->mailData($email_template, $order->customer->first_name, $order->customer_email, $order->order_number);
                            $message = (string) view('emails.mail', $datas);
                            if(config('queue.default') == 'sync'){
                                $this->phpMailData($order->customer_email, $email_template->subject, $message);
                            }else{
                                dispatch(new SendmailJob($order->customer_email, $email_template->subject, $message));
                            }
                        } else {
                            $datas = $this->mailData($email_template, $order->guest_info->billing_name, $order->guest_info->billing_email, $order->order_number);
                            $message = (string) view('emails.mail', $datas);
                            if(config('queue.default') == 'sync'){
                                $this->phpMailData($order->guest_info->billing_email, $email_template->subject, $message);
                            }else{
                                dispatch(new SendmailJob($order->guest_info->billing_email, $email_template->subject, $message));
                            }
                        }
                    }
                    if (in_array("seller", json_decode($email_template->reciepnt_type))) {
                        foreach ($order->packages as $key => $package) {
                            if ($package->seller->email) {
                                $datas = $this->mailData($email_template, $package->seller->first_name, $package->seller->email, $package->package_code);
                                $message = (string) view('emails.mail', $datas);
                                if(config('queue.default') == 'sync'){
                                    $this->phpMailData($package->seller->email, $email_template->subject, $message);
                                }else{
                                    dispatch(new SendmailJob($package->seller->email, $email_template->subject, $message));
                                }
                            }
                        }
                    }
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
        }
    }
    function sendOrderRefundorDeliveryProcessMail($order, $relatable_type, $relatable_id)
    {
        try {
            $email_template = EmailTemplate::where('relatable_type', $relatable_type)->where('relatable_id', $relatable_id)->first();
            if ($email_template && $email_template->is_active == 1) {
                if (app('general_setting')->mail_protocol == "smtp") {
                    if (in_array("customer", json_decode($email_template->reciepnt_type))) {
                        if ($order->customer_id) {
                            $datas = $this->mailData($email_template, $order->customer->first_name, $order->customer_email, $order->order_number);
                            Mail::to($order->customer_email)->queue(new SendQueueMail($datas));
                        } else {
                            $datas = $this->mailData($email_template, $order->guest_info->billing_name, $order->guest_info->billing_email, $order->order_number);
                            Mail::to($order->guest_info->billing_email)->queue(new SendQueueMail($datas));
                        }
                    }
                    if (in_array("seller", json_decode($email_template->reciepnt_type))) {
                        foreach ($order->packages as $key => $package) {
                            if ($package->seller->email) {
                                $datas = $this->mailData($email_template, $package->seller->first_name, $package->seller->email, $package->package_code);
                                Mail::to($package->seller->email)->queue(new SendQueueMail($datas));
                            }
                        }
                    }
                    return true;
                } elseif (app('general_setting')->mail_protocol == "sendmail") {
                    if (in_array("customer", json_decode($email_template->reciepnt_type))) {
                        if ($order->customer_id) {
                            $datas = $this->mailData($email_template, $order->customer->first_name, $order->customer_email, $order->order_number);
                            $message = (string) view('emails.mail', $datas);
                            if(config('queue.default') == 'sync'){
                                $this->phpMailData($order->customer_email, $email_template->subject, $message);
                            }else{
                                dispatch(new SendmailJob($order->customer_email, $email_template->subject, $message));
                            }
                        } else {
                            $datas = $this->mailData($email_template, $order->guest_info->billing_name, $order->guest_info->billing_email, $order->order_number);
                            $message = (string) view('emails.mail', $datas);
                            if(config('queue.default') == 'sync'){
                                $this->phpMailData($order->guest_info->billing_email, $email_template->subject, $message);
                            }else{
                                dispatch(new SendmailJob($order->guest_info->billing_email, $email_template->subject, $message));
                            }
                        }
                    }
                    if (in_array("seller", json_decode($email_template->reciepnt_type))) {
                        foreach ($order->packages as $key => $package) {
                            if ($package->seller->email) {
                                $datas = $this->mailData($email_template, $package->seller->first_name, $package->seller->email, $package->package_code);
                                $message = (string) view('emails.mail', $datas);
                                if(config('queue.default') == 'sync'){
                                    $this->phpMailData($package->seller->email, $email_template->subject, $message);
                                }else{
                                    dispatch(new SendmailJob($package->seller->email, $email_template->subject, $message));
                                }
                            }
                        }
                    }
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
        }
    }
    function sendGiftCardSecretCodeMail($order, $to_mail, $gift_card, $secret_code)
    {
        try {
            $email_template = EmailTemplate::where('type_id', 15)->where('is_active', 1)->first();
            if ($email_template && $email_template->is_active == 1) {
                if (app('general_setting')->mail_protocol == "smtp") {
                    if (in_array("customer", json_decode($email_template->reciepnt_type))) {
                        if ($order->customer_id) {
                            $datas = $this->mailDataGiftCard($email_template, $order->customer->first_name, $to_mail, $order->order_number, $secret_code, $gift_card->name);
                            Mail::to($to_mail)->queue(new SendQueueMail($datas));
                        } else {
                            $datas = $this->mailDataGiftCard($email_template, $order->guest_info->shipping_name, $to_mail, $order->order_number, $secret_code, $gift_card->name);
                            Mail::to($to_mail)->queue(new SendQueueMail($datas));
                        }
                    }
                    return true;
                } elseif (app('general_setting')->mail_protocol == "sendmail") {
                    if (in_array("customer", json_decode($email_template->reciepnt_type))) {
                        if ($order->customer_id) {
                            $datas = $this->mailDataGiftCard($email_template, $order->customer->first_name, $to_mail, $order->order_number, $secret_code, $gift_card->name);
                            $message = (string) view('emails.mail', $datas);
                            if(config('queue.default') == 'sync'){
                                return $this->phpMailData($to_mail, $email_template->subject, $message);
                            }else{
                                dispatch(new SendmailJob($to_mail, $email_template->subject, $message));
                                return true;
                            }
                        } else {
                            $datas = $this->mailData($email_template, $order->guest_info->shipping_name, $to_mail, $order->order_number, $secret_code, $gift_card->name);
                            $message = (string) view('emails.mail', $datas);
                            if(config('queue.default') == 'sync'){
                                return $this->phpMailData($to_mail, $email_template->subject, $message);
                            }else{
                                dispatch(new SendmailJob($to_mail, $email_template->subject, $message));
                                return true;
                            }
                        }
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
        }
    }
    // send digital file
    function sendDigitalFileMail($to_mail, $download_link, $data = null)
    {
        try {
            $email_template = EmailTemplate::where('type_id', 43)->where('is_active', 1)->first();
            if($email_template){
                if(@$data['customer_id']){
                    $customer = User::find($data['customer_id']);
                    $customer_name = $customer->first_name;
                }else{
                    $customer_name = '';
                }
                $link = "'<a href='" .  $download_link . "'>Click Here to download</a>'";
                $datas = $this->mailData($email_template, $customer_name, $to_mail, null, null, null, null, $link);
                if (app('general_setting')->mail_protocol == "smtp") {
                    Mail::to($to_mail)->queue(new SendQueueMail($datas));
                    return true;
                }elseif(app('general_setting')->mail_protocol == "sendmail"){
                    if(config('queue.default') == 'sync'){
                        return $this->phpMailData($to_mail, $datas["title"], $datas["body"]);
                    }else{
                        dispatch(new SendmailJob($to_mail, $datas["title"], $datas["body"]));
                        return true;
                    }
                }
            }
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
        }
    }
    // send newsletter email verify mail
    public function sendNewsletterVerifyMail($data){
        try {
            $verify_link = url('').'/subscription/email-verify?email='.$data->email.'&verify_code='.$data->verify_code;
            $verify_link = "<a href='" .  $verify_link . "'>Click Here</a>";
            $email_template = EmailTemplate::where('type_id', 42)->where('is_active', 1)->first();
            $datas = $this->mailData($email_template, '', $data->email, '', null, null,$verify_link);
            if (app('general_setting')->mail_protocol == "smtp") {
                Mail::to($data->email)->queue(new SendQueueMail($datas));
                return true;
            }elseif(app('general_setting')->mail_protocol == "sendmail"){
                $message = (string) view('emails.mail', $datas);
                if(config('queue.default') == 'sync'){
                    return $this->phpMailData($data->email, $datas['title'], $message);
                }else{
                    dispatch(new SendmailJob($data->email, $datas['title'], $message));
                    return true;
                }
            }
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
        }
    }
    public function mailData($email_template, $to_name, $to_mail, $order_tracking_number, $custom_message = null, $RESET_URL = null,$VERIFICATION_LINK = null, $DIGITAL_FILE_LINK = null)
    {
        $datas["email"] = app('general_setting')->email;
        $datas["title"] = $email_template->subject;
        $datas['from'] = env('MAIL_FROM_ADDRESS');
        $datas["body"] = $email_template->value;
        $datas["body"] = str_replace("{SECRET_CODE}", $order_tracking_number, $datas["body"]);
        $datas["body"] = str_replace("{USER_FIRST_NAME}", $to_name, $datas["body"]);
        $datas["body"] = str_replace("{USER_EMAIL}", $to_mail, $datas["body"]);
        $datas["body"] = str_replace("{EMAIL_SIGNATURE}", app('general_setting')->mail_signature, $datas["body"]);
        $datas["body"] = str_replace("{ORDER_TRACKING_NUMBER}", $order_tracking_number, $datas["body"]);
        $datas["body"] = str_replace("{EMAIL_FOOTER}", $email_template->footer, $datas["body"]);
        $datas["body"] = str_replace("{WEBSITE_NAME}", app('general_setting')->site_title, $datas["body"]);
        $datas["body"] = str_replace("{CUSTOM_MESSAGE}", $custom_message, $datas["body"]);
        $datas["body"] = str_replace("{RESET_URL}", $RESET_URL, $datas["body"]);
        $datas["body"] = str_replace("{VERIFICATION_LINK}", $VERIFICATION_LINK, $datas["body"]);
        $datas["body"] = str_replace("{DIGITAL_FILE_LINK}", $DIGITAL_FILE_LINK, $datas["body"]);
        return $datas;
    }

    public function contactMailData($email_template, $to_name, $to_mail, $to_phone, $to_interested, $custom_message = null)
    {
        $datas["email"] = app('general_setting')->email;
        $datas["title"] = $email_template->subject;
        $datas['from'] = env('MAIL_FROM_ADDRESS');
        $datas["body"] = $email_template->value;
        $datas["body"] = str_replace("{USER_FIRST_NAME}", $to_name, $datas["body"]);
        $datas["body"] = str_replace("{USER_EMAIL}", $to_mail, $datas["body"]);
        $datas["body"] = str_replace("{USER_PHONE}", $to_phone, $datas["body"]);
        $datas["body"] = str_replace("{USER_INTERESTED}", $to_interested, $datas["body"]);
        $datas["body"] = str_replace("{CUSTOM_MESSAGE}", $custom_message, $datas["body"]);
        $datas["body"] = str_replace("{EMAIL_FOOTER}", $email_template->footer, $datas["body"]);
        $datas["body"] = str_replace("{WEBSITE_NAME}", app('general_setting')->site_title, $datas["body"]);
        return $datas;
    }

    public function otpMailData($email_template,$to_name,$to_mail,$otp)
    {
        $datas["email"] = app('general_setting')->email;
        $datas["title"] = $email_template->subject;
        $datas['from'] = env('MAIL_FROM_ADDRESS');
        $datas["body"] = $email_template->value;
        $datas["body"] = str_replace("{USER_FIRST_NAME}", $to_name, $datas["body"]);
        $datas["body"] = str_replace("{USER_EMAIL}", $to_mail, $datas["body"]);
        $datas["body"] = str_replace("{OTP}", $otp, $datas["body"]);
        return $datas;
    }

    public function mailInvoiceData($email_template, $to_name, $to_mail, $order)
    {
        $datas["email"] = app('general_setting')->email;
        $datas["title"] = $email_template->subject;
        $datas["body"] = $email_template->value;
        $datas["body"] = str_replace("{USER_FIRST_NAME}", $to_name, $datas["body"]);
        $datas["body"] = str_replace("{USER_EMAIL}", $to_mail, $datas["body"]);
        $datas["body"] = str_replace("{EMAIL_SIGNATURE}", app('general_setting')->mail_signature, $datas["body"]);
        $datas["body"] = str_replace("{ORDER_TRACKING_NUMBER}", $order->order_number, $datas["body"]);
        $datas["body"] = str_replace("{EMAIL_FOOTER}", $email_template->footer, $datas["body"]);
        $datas["body"] = str_replace("{WEBSITE_NAME}", app('general_setting')->site_title, $datas["body"]);
        $datas["body"] = str_replace("{RECIEVER_EMAIL}", @$order->shipping_address->email, $datas["body"]);
        $datas["body"] = str_replace("{RECIEVER_PHONE}", @$order->shipping_address->phone, $datas["body"]);
        $datas["body"] = str_replace("{RECIEVER_ADDRESS}", @$order->shipping_address->address, $datas["body"]);
        $datas["body"] = str_replace("{RECIEVER_CITY}", @$order->shipping_address->city->name, $datas["body"]);
        $datas["body"] = str_replace("{RECIEVER_STATE}", @$order->shipping_address->state->name, $datas["body"]);
        $datas["body"] = str_replace("{RECIEVER_COUNTRY}", @$order->shipping_address->country->name, $datas["body"]);
        $datas["inv_details"] = (string) view(theme('pages.profile.order_pdf'), compact('order'));
        return $datas;
    }

    public function phpMailData($to, $subject, $message)
    {
        try {
            $headers = "From:  ".env('SENDER_NAME') ." <".env('SENDER_MAIL').">"  . " \r\n";
            $headers .= "Reply-To: " . app('general_setting')->email . " \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";
            return mail($to, $subject, $message, $headers);
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return false;
        }
    }

    public function mailDataGiftCard($email_template, $to_name, $to_mail, $order_tracking_number, $secret_code,$gift_card_name)
    {
        $datas["email"] = app('general_setting')->email;
        $datas["title"] = $email_template->subject;
        $datas["body"] = $email_template->value;
        $datas["body"] = str_replace("{USER_FIRST_NAME}", $to_name, $datas["body"]);
        $datas["body"] = str_replace("{USER_EMAIL}", $to_mail, $datas["body"]);
        $datas["body"] = str_replace("{EMAIL_SIGNATURE}", app('general_setting')->mail_signature, $datas["body"]);
        $datas["body"] = str_replace("{ORDER_TRACKING_NUMBER}", $order_tracking_number, $datas["body"]);
        $datas["body"] = str_replace("{EMAIL_FOOTER}", $email_template->footer, $datas["body"]);
        $datas["body"] = str_replace("{WEBSITE_NAME}", app('general_setting')->site_title, $datas["body"]);
        $datas["body"] = str_replace("{SECRET_CODE}", $secret_code, $datas["body"]);
        $datas["body"] = str_replace("{GIFT_CARD_NAME}", $gift_card_name, $datas["body"]);
        return $datas;
    }

    public function phpMailDataGiftCard($to, $subject, $message)
    {
        try {
            $headers = "From:  ".env('SENDER_NAME') ." <".env('SENDER_MAIL').">"  . " \r\n";
            $headers .= "Reply-To: " . app('general_setting')->email . " \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";
            return mail($to, $subject, $message, $headers);
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return false;
        }
    }
    public function phpMailDigitalfile($to, $subject, $message)
    {
        try {
            $headers = "From:  ".env('SENDER_NAME') ." <".env('SENDER_MAIL').">"  . " \r\n";
            $headers .= "Reply-To: " . app('general_setting')->email . " \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";
            return mail($to, $subject, $message, $headers);
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return false;
        }
    }

    public function userActivationMailSend($type, $user)
    {
        $emailType = EmailTemplateType::where('type',$type)->first();
        if($emailType){
            $email_template = EmailTemplate::where('type_id', $emailType->id)->where('is_active', 1)->first();
            if ($email_template) {
                try {
                    if (app('general_setting')->mail_protocol == "smtp") {
                        $datas = $this->activationMailData($email_template, $user);
                        Mail::to($user->email)->queue(new SendQueueMail($datas));
                        return true;
                    } elseif (app('general_setting')->mail_protocol == "sendmail") {
                        $datas = $this->activationMailData($email_template,$user);
                        $message = (string) view('emails.mail', $datas);
                        if(config('queue.default') == 'sync'){
                            return $this->phpMailData($user->email, $email_template->subject, $message);
                        }else{
                            dispatch(new SendmailJob($user->email, $email_template->subject, $message));
                            return true;
                        }
                    } else {
                        return false;
                    }
                } catch (\Exception $e) {
                    LogActivity::errorLog($e->getMessage());
                    return false;
                }
            }
            return false;
        }
        return false;
    }


    public function newUserRegistradEmailSend($type, $user)
    {
        $admin = User::where('id',1)->first();
        if($admin){
            $emailType = EmailTemplateType::where('type',$type)->first();
            if($emailType){
                $email_template = EmailTemplate::where('type_id', $emailType->id)->where('is_active', 1)->first();
                if ($email_template) {
                    try {
                        if (app('general_setting')->mail_protocol == "smtp") {
                            $datas = $this->registrationMailData($email_template, $user);
                            Mail::to($admin->email)->queue(new SendQueueMail($datas));
                            return true;
                        } elseif (app('general_setting')->mail_protocol == "sendmail") {
                            $datas = $this->registrationMailData($email_template,$user);
                            $message = (string) view('emails.mail', $datas);
                            if(config('queue.default') == 'sync'){
                                return $this->phpMailData($admin->email, $email_template->subject, $message);
                            }else{
                                dispatch(new SendmailJob($admin->email, $email_template->subject, $message));
                                return true;
                            }
                        } else {
                            return false;
                        }
                    } catch (\Exception $e) {
                        LogActivity::errorLog($e->getMessage());
                        return false;
                    }
                }
                return false;
            }
            return false;
        }
        return false;

    }

    public function activationMailData($email_template,$user){
        $datas["email"] = app('general_setting')->email;
        $datas["title"] = $email_template->subject;
        $datas['from'] = env('MAIL_FROM_ADDRESS');
        $datas["body"] = $email_template->value;
        $datas["body"] = str_replace("{USER_FIRST_NAME}", $user->name, $datas["body"]);
        $datas["body"] = str_replace("{APP_NAME}", config('app.name'), $datas["body"]);
        $siteUrl = app('general_setting')->website_url
            ?: config('app.url')
            ?: env('APP_URL')
            ?: url('/');
        $datas["body"] = str_replace("{SITE_URL}", rtrim((string) $siteUrl, '/'), $datas["body"]);
        $datas["body"] = str_replace("{EMAIL_SIGNATURE}", app('general_setting')->mail_signature, $datas["body"]);
        return $datas;
    }


    public function registrationMailData($email_template,$user)
    {
        $datas["email"] = app('general_setting')->email;
        $datas["title"] = $email_template->subject;
        $datas['from'] = env('MAIL_FROM_ADDRESS');
        $datas["body"] = $email_template->value;
        $datas["body"] = str_replace("{CUSTOMER_NAME}", $user->name, $datas["body"]);
        $datas["body"] = str_replace("{CUSTOMER_EMAIL}", $user->email, $datas["body"]);
        $datas["body"] = str_replace("{APP_NAME}", config('app.name'), $datas["body"]);
        $siteUrl = app('general_setting')->website_url
            ?: config('app.url')
            ?: env('APP_URL')
            ?: url('/');
        $datas["body"] = str_replace("{SITE_URL}", rtrim((string) $siteUrl, '/'), $datas["body"]);
        $datas["body"] = str_replace("{EMAIL_SIGNATURE}", app('general_setting')->mail_signature, $datas["body"]);
        return $datas;
    }
}
