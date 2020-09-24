<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Model\PhilippineBarangay;

class PhilippineBarangayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PhilippineBarangay::truncate();
        // Import the data
        $to_import = public_path('database/philippines-addresses-tmp/barangays.sql');
        DB::unprepared(file_get_contents($to_import));
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
