<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\City;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		City::truncate();
        // Import the countries data
        $to_import = public_path('sql/cities.sql');
        DB::unprepared(file_get_contents($to_import));
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
