<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Helpers\Utility;

class CreateOrderPaymentPayoutBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('order_payment_payout_batches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('partner_id')->index();
            $table->string('batch_no')->unique();
            $table->date('date_from');
            $table->date('date_to');
            $table->decimal('commission_percentage', 3,2);
            $table->enum('type', ['cash', 'online_payment']);
            $table->string('key_token')->unique();
            $table->timestamps();

            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade')->onUpdate('cascade');
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
            $table->dropForeign(['partner_id']);
        });

        $table->dropForeign(['partner_id']);

        Schema::dropIfExists('order_payment_payout_batches');
    }
}
