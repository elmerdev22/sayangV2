<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateFromAndDateToColumnInOrderPaymentPayouts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_payment_payouts', function (Blueprint $table) {
            $table->date('date_from')->after('payout_no');
            $table->date('date_to')->after('date_from');
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
