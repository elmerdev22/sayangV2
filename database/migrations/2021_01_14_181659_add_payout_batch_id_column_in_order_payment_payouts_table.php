<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPayoutBatchIdColumnInOrderPaymentPayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_payment_payouts', function (Blueprint $table) {
            $table->unsignedBigInteger('payout_batch_id')->index()->after('id');
            $table->foreign('payout_batch_id')->references('id')->on('order_payment_payout_batches')->onDelete('cascade')->onUpdate('cascade');
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
            $table->dropForeign(['payout_batch_id']);
        });
    }
}
