<?php

use Illuminate\Database\Seeder;
use App\Helpers\SettingsUtility;

class SocialMediaSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingsUtility::social_media_settings_set_default();
    }
}
