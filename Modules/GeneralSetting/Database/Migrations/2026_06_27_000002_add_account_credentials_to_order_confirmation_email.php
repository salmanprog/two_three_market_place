<?php

use Illuminate\Database\Migrations\Migration;
use Modules\GeneralSetting\Entities\EmailTemplate;
use Modules\GeneralSetting\Entities\EmailTemplateType;

class AddAccountCredentialsToOrderConfirmationEmail extends Migration
{
    public function up()
    {
        $type = EmailTemplateType::where('type', 'order_invoice_template')->first();

        if (! $type) {
            return;
        }

        $template = EmailTemplate::where('type_id', $type->id)->first();

        if (! $template) {
            return;
        }

        $template->update([
            'value' => '<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#f4f4f4;padding:30px 15px;font-family:Open Sans,Helvetica Neue,Helvetica,Arial,sans-serif;">
    <tr>
        <td align="center">
            <table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="max-width:600px;width:100%;background-color:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                <tr>
                    <td style="background-color:#000000;padding:35px 30px;text-align:center;">
                        <h1 style="margin:0;font-size:28px;font-weight:600;color:#ffffff;line-height:1.3;">Thank You!</h1>
                        <p style="margin:10px 0 0;font-size:15px;color:#cccccc;line-height:1.5;">Your order has been placed successfully</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:35px 30px;">
                        <p style="margin:0 0 16px;font-size:16px;color:#333333;line-height:1.6;">Hello <strong>{USER_FIRST_NAME}</strong>,</p>
                        <p style="margin:0 0 20px;font-size:15px;color:#555555;line-height:1.7;">Thank you for shopping with <strong>{APP_NAME}</strong>. We have received your order and it is being processed.</p>
                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#f9f9f9;border:1px solid #eeeeee;border-radius:6px;margin-bottom:24px;">
                            <tr>
                                <td style="padding:16px 20px;">
                                    <p style="margin:0 0 8px;font-size:14px;color:#333333;line-height:1.6;"><strong>Order Number:</strong> {ORDER_NUMBER}</p>
                                    <p style="margin:0 0 8px;font-size:14px;color:#333333;line-height:1.6;"><strong>Order Date:</strong> {ORDER_DATE}</p>
                                    <p style="margin:0;font-size:14px;color:#333333;line-height:1.6;"><strong>Order Total:</strong> {ORDER_TOTAL}</p>
                                </td>
                            </tr>
                        </table>
                        <p style="margin:0 0 12px;font-size:15px;color:#333333;font-weight:600;">Order Items</p>
                        {ORDER_ITEMS}
                        {ACCOUNT_CREDENTIALS}
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:24px auto 0;">
                            <tr>
                                <td style="background-color:#000000;border-radius:5px;">
                                    <a href="{ORDER_LINK}" target="_blank" style="display:inline-block;padding:14px 32px;font-size:15px;font-weight:600;color:#ffffff;text-decoration:none;">View Your Order</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 30px 30px;">
                        <hr style="border:none;border-top:1px solid #eeeeee;margin:0 0 20px;">
                        <p style="margin:0;font-size:14px;color:#666666;line-height:1.6;">{EMAIL_SIGNATURE}</p>
                    </td>
                </tr>
                <tr>
                    <td style="background-color:#f8f8f8;padding:18px 30px;text-align:center;border-top:1px solid #eeeeee;">
                        <p style="margin:0;font-size:12px;color:#999999;line-height:1.5;">&copy; {APP_NAME}. All rights reserved.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>',
        ]);
    }

    public function down()
    {
        //
    }
}
