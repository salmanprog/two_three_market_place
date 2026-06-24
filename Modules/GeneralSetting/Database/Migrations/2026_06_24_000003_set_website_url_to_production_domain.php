<?php

use Illuminate\Database\Migrations\Migration;
use Modules\GeneralSetting\Entities\GeneralSetting;

class SetWebsiteUrlToProductionDomain extends Migration
{
    public function up()
    {
        $setting = GeneralSetting::first();

        if ($setting) {
            $setting->update([
                'website_url' => 'https://23-ld.com',
            ]);
        }
    }

    public function down()
    {
        //
    }
}
