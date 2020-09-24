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
        // Import data
        $content = file_get_contents(public_path('database/philippines-addresses/cities.json'));
        $data    = json_decode($content);
        
        foreach($data as $row){
            $new              = new PhilippineCity();
            $new->id          = $row->id;
            $new->province_id = $row->province_id;
            $new->psgc_code   = $row->psgc_code;
            $new->name        = $row->name;
            $new->code        = $row->code;
            $new->save();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
