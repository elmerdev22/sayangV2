<?php

use Illuminate\Database\Seeder;
use App\Helpers\SettingsUtility;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingsUtility::settings_set_default();
    }
}
