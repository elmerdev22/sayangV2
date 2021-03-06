<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPartnerIdForeignColumnInOrderPaymentPayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('order_payment_payouts', 'partner_id')){
            Schema::table('order_payment_payouts', function (Blueprint $table) {
                $table->unsignedBigInteger('partner_id')->index()->after('id');
                $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade')->onUpdate('cascade');
            });
        }
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
