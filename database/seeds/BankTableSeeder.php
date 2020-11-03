<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Model\Bank;
use App\Helpers\Utility;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Asia United Bank (AUB)', 
            'BPI Family Savings Bank', 
            'Banco De Oro Bank (BDO)', 
            'Bank of Commerce',
            'Bank of the Philippine Island (BPI)',
            'CTBC Bank',
            'China Banking Corporation (Chinabank)',
            'Chinabank Savings',
            'Citi Bank',
            'East West Bank',
            'GCash',
            'Grab Pay',
            'Land bank of the Philippines (Landbank)',
            'Maybank Philippines',
            'Metropolitan Bank and Trust Company (Metrobank)',
            'Paymaya',
            'Philippine Bank of Communications (PBCom)',
            'Philippine National Bank (PNB)',
            'Philippine Savings Bank (PSBank)',
            'Philippine Trust Company (Philtrust Bank)',
            'Rizal Commercial Banking Corporation (RCBC)',
            'Robinsons Bank Corporation (Robinson Bank)',
            'Security Bank Corporation (Security Bank)',
            'Union Bank of the Philippines (Unionbank)',
            'United Coconut Planters Bank (UCPB)'
        ];

        $active_payment = array('GCash');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Bank::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach($data as $name){
            $slug           = Utility::generate_table_slug('Bank', $name);
            $bank           = new Bank();
            $bank->name     = $name;
            $bank->key_name = str_replace('-', '_', $slug);
            $bank->slug     = $slug;
            if(!in_array($name, $active_payment)){
                $bank->is_active = false;
            }
            $bank->key_token = Utility::generate_table_token('Bank');
            $bank->save();
        }
    }
}
