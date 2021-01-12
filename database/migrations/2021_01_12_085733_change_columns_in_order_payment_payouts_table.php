<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Model\OrderPaymentPayout;
use App\Helpers\Utility;

class ChangeColumnsInOrderPaymentPayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $order_payment_payout = OrderPaymentPayout::count();
        if($order_payment_payout > 0){
            OrderPaymentPayout::truncate();
        }

        Schema::table('order_payment_payouts', function (Blueprint $table) {
            $foreigns = Utility::table_foreign_keys('order_payment_payouts');
            if(in_array('order_payment_payouts_order_payment_id_foreign', $foreigns)){
                $table->dropForeign(['order_payment_id']);
            }
            $table->dropColumn('order_payment_id');
            $table->string('payout_no')->unique()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_payment_payouts', function (Blueprint $table) {
            //
        });
    }
}
