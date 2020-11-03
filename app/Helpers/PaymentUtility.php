<?php
namespace App\Helpers;

use App\Model\Bank;

class PaymentUtility{
    
    public static function active_payments(){
        $response = [];
        
        $data = Bank::where('is_active', true)->orderBy('name', 'asc')->get();
        
        foreach($data as $row){
            $response[] = $row->id;
        }

        return $response;
    }
}