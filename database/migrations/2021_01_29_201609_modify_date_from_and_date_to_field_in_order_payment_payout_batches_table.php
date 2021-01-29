<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDateFromAndDateToFieldInOrderPaymentPayoutBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::getConnection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        Schema::table('order_payment_payout_batches', function (Blueprint $table) {
            if(Schema::hasColumn('order_payment_payout_batches', 'date_from')){
                $table->date('date_from')->nullable()->change();
            }
            if(Schema::hasColumn('order_payment_payout_batches', 'date_to')){
                $table->date('date_to')->nullable()->change();
            }
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
