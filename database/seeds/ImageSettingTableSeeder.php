<?php

use Illuminate\Database\Seeder;
use App\Helpers\SettingsUtility;

class ImageSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingsUtility::image_settings_set_default();
    }
}
