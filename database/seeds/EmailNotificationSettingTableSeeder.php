<?php

use Illuminate\Database\Seeder;
use App\Helpers\SettingsUtility;

class EmailNotificationSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingsUtility::email_notication_settings_set_default();
    }
}
