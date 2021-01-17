<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePartnerIdColumnInOrderPaymentPayoutBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_payment_payout_batches', function (Blueprint $table) {
            $foreigns = Utility::table_foreign_keys('order_payment_payout_batches');
            if(in_array('order_payment_payout_batches_partner_id_foreign', $foreigns)){
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
        Schema::table('order_payment_payout_batches', function (Blueprint $table) {
            //
        });
    }
}
