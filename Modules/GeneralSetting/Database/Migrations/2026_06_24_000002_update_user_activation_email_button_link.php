<?php

use Illuminate\Database\Migrations\Migration;
use Modules\GeneralSetting\Entities\EmailTemplate;
use Modules\GeneralSetting\Entities\EmailTemplateType;

class UpdateUserActivationEmailButtonLink extends Migration
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

        $value = $template->value;
        $value = preg_replace(
            '/<p style="margin:0;font-size:13px;color:#888888;line-height:1\.6;">If the button above does not work.*?<\/p>/s',
            '',
            $value
        );
        $value = str_replace('{SITE_URL}/account-signin', '{SITE_URL}', $value);

        $template->update(['value' => $value]);
    }

    public function down()
    {
        //
    }
}
