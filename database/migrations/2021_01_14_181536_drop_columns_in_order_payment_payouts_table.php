<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsInOrderPaymentPayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_payment_payouts', function (Blueprint $table) {
            $table->dropColumn('batch_no');
            $table->dropColumn('date_from');
            $table->dropColumn('date_to');
            $table->dropColumn('commission_percentage');
            $table->dropColumn('type');
            $foreigns = Utility::table_foreign_keys('order_payment_payouts');
            if(in_array('order_payment_payouts_partner_id_foreign', $foreigns)){
                $table->dropForeign(['partner_id']);
            }
            $table->dropColumn('partner_id');
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
