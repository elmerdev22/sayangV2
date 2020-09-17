<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\RegionProvince;

class RegionProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		RegionProvince::truncate();
        // Import the countries data
        $to_import = public_path('sql/region_provinces.sql');
        DB::unprepared(file_get_contents($to_import));
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
