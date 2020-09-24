<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Model\PhilippineCity;

class PhilippineCityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PhilippineCity::truncate();
        // Import the countries data
        $to_import = public_path('database/philippines-addresses-tmp/cities.sql');
        DB::unprepared(file_get_contents($to_import));
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
