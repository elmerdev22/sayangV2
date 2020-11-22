<?php

use Illuminate\Database\Seeder;
use App\Helpers\SettingsUtility;

class WebNotificationSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingsUtility::web_notication_settings_set_default();
    }
}
