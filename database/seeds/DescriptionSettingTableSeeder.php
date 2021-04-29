<?php

use Illuminate\Database\Seeder;
use App\Helpers\SettingsUtility;

class DescriptionSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingsUtility::description_settings_set_default();
    }
}
