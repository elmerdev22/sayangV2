<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentPayoutItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payment_payout_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_payment_id')->index();
            $table->unsignedBigInteger('order_payment_payout_id')->index();
            $table->timestamps();

            $table->foreign('order_payment_id')->references('id')->on('order_payments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('order_payment_payout_id')->references('id')->on('order_payment_payouts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_payment_payout_items', function (Blueprint $table){
            $table->dropForeign(['order_payment_id']);
            $table->dropForeign(['order_payment_payout_id']);
        });
        Schema::dropIfExists('order_payment_payout_items');
    }
}
