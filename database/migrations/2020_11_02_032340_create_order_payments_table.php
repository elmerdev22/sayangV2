<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->index();
            // Bank ID if the payment method is online
            $table->unsignedBigInteger('bank_id')->index()->nullable();

            $table->enum('payment_method', ['card', 'cash_on_delivery', 'online_payment']);
            
            // If payment method is Card
            $table->string('card_holder', 255)->nullable();
            $table->string('card_no', 50)->nullable();
            $table->date('card_expiration_date')->nullable();
            $table->string('card_verification_value')->nullable();

            //If payment method is online payment
            $table->string('account_name', 255)->nullable();
            $table->string('account_no', 50)->nullable();

            $table->enum('status', ['cancelled', 'paid', 'pending'])->default('pending');
            $table->timestamp('date_paid')->nullable();
            $table->string('key_token')->unique();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_payments', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropColumn('order_id');
        });
        Schema::dropIfExists('order_payments');
    }
}
