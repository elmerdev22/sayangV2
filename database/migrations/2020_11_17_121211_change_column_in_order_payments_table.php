<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Model\OrderPayment;

class ChangeColumnInOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $ids  = [];
        $data = OrderPayment::where('payment_method', 'online_payment');

        if($data->count() > 0){
            foreach($data->get() as $row){
                $row->payment_method = null;
                $row->save();
                $ids[] = $row->id;
            }
        }

        DB::statement("ALTER TABLE order_payments MODIFY COLUMN payment_method ENUM('card', 'cash_on_delivery', 'e_wallet')");

        if(count($ids) > 0){
            foreach($ids as $id){
                $payment = OrderPayment::find($id);
                if($payment){
                    $payment->payment_method = 'e_wallet';
                    $payment->save();
                }
            }
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_payments', function (Blueprint $table) {
            //
        });
    }
}
