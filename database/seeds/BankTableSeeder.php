<?php

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

        foreach($data as $name){
            $bank            = new Bank();
            $bank->name      = $name;
            $bank->slug      = Utility::generate_table_slug('Bank', $name);
            $bank->key_token = Utility::generate_table_token('Bank');
            $bank->save();
        }
    }
}
