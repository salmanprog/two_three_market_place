<?php

use Illuminate\Database\Migrations\Migration;
use Modules\GeneralSetting\Entities\EmailTemplate;
use Modules\GeneralSetting\Entities\EmailTemplateType;
use Modules\GeneralSetting\Entities\GeneralSetting;

class FixUserActivationEmailTemplate extends Migration
{
    public function up()
    {
        $type = EmailTemplateType::where('type', 'user_activation_template')->first();

        if (!$type) {
            return;
        }

        $template = EmailTemplate::where('type_id', $type->id)->first();

        if (!$template) {
            return;
        }

        $template->update([
            'subject' => 'Congratulations! Your Account Has Been Activated',
            'value' => '<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#f4f4f4;padding:30px 15px;font-family:Open Sans,Helvetica Neue,Helvetica,Arial,sans-serif;">
    <tr>
        <td align="center">
            <table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="max-width:600px;width:100%;background-color:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                <tr>
                    <td style="background-color:#000000;padding:35px 30px;text-align:center;">
                        <h1 style="margin:0;font-size:28px;font-weight:600;color:#ffffff;line-height:1.3;">Congratulations!</h1>
                        <p style="margin:10px 0 0;font-size:15px;color:#cccccc;line-height:1.5;">Your account has been approved</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:35px 30px;">
                        <p style="margin:0 0 16px;font-size:16px;color:#333333;line-height:1.6;">Hello <strong>{USER_FIRST_NAME}</strong>,</p>
                        <p style="margin:0 0 16px;font-size:15px;color:#555555;line-height:1.7;">We are pleased to inform you that your account at <strong>{APP_NAME}</strong> has been reviewed and successfully activated.</p>
                        <p style="margin:0 0 24px;font-size:15px;color:#555555;line-height:1.7;">You can now sign in and start using your account. Welcome aboard!</p>
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:0 auto 24px;">
                            <tr>
                                <td style="background-color:#000000;border-radius:5px;">
                                    <a href="{SITE_URL}" target="_blank" style="display:inline-block;padding:14px 32px;font-size:15px;font-weight:600;color:#ffffff;text-decoration:none;">Sign In to Your Account</a>
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

        $setting = GeneralSetting::first();

        if ($setting && in_array(strtolower(trim($setting->mail_signature)), ['mail signature', ''], true)) {
            $siteTitle = $setting->site_title ?: config('app.name');
            $setting->update([
                'mail_signature' => 'Best regards,<br><strong>' . $siteTitle . ' Team</strong>',
            ]);
        }
    }

    public function down()
    {
        // Intentionally left empty — previous template HTML was broken.
    }
}
