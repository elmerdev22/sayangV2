<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payment_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_payment_id')->index();
            $table->string('api')->nullable();
            $table->longtext('logs')->nullable();
            $table->timestamps();

            $table->foreign('order_payment_id')->references('id')->on('order_payments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_payment_logs', function (Blueprint $table) {
            $table->dropForeign(['order_payment_id']);
            $table->dropColumn('order_payment_id');
        });
        Schema::dropIfExists('order_payment_logs');
    }
}
