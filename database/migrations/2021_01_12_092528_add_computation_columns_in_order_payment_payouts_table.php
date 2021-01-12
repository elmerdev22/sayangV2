<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddComputationColumnsInOrderPaymentPayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_payment_payouts', function (Blueprint $table) {
            $table->decimal('total_amount', 11,2)->after('date_to');
            $table->decimal('sayang_commission', 11,2)->after('commission_percentage');
            $table->decimal('paymongo_fee', 11,2)->after('sayang_commission')->default(0.00)->nullable();
            $table->decimal('foreign_fee', 11,2)->after('paymongo_fee')->default(0.00)->nullable();
            $table->decimal('net_amount', 11,2)->after('foreign_fee')->nullable();
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
