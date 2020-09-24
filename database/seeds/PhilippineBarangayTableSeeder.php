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
        // Import data
        $content = file_get_contents(public_path('database/philippines-addresses/barangays.json'));
        $data    = json_decode($content);
        
        foreach($data as $row){
            $new          = new PhilippineBarangay();
            $new->id      = $row->id;
            $new->city_id = $row->city_id;
            $new->name    = $row->name;
            $new->code    = $row->code;
            $new->save();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
