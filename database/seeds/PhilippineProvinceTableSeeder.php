<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Model\PhilippineProvince;

class PhilippineProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        PhilippineProvince::truncate();
        // Import data
        $content = file_get_contents(public_path('database/philippines-addresses/provinces.json'));
        $data    = json_decode($content);
        
        foreach($data as $row){
            $new            = new PhilippineProvince();
            $new->id        = $row->id;
            $new->region_id = $row->region_id;
            $new->psgc_code = $row->psgc_code;
            $new->name      = $row->name;
            $new->code      = $row->code;
            $new->save();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
