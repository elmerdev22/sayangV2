<?php

use Illuminate\Database\Seeder;
use App\Helpers\SettingsUtility;

class RatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingsUtility::ratings_set_default();
    }
}
