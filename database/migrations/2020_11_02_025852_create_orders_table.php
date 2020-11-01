<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('billing_id')->index();
            $table->unsignedBigInteger('partner_id')->index();
            $table->string('order_no', 255)->unique();
            $table->string('qr_no', 255)->unique();
            /* 
                Status Step Arrangement:
                1   => Order Placed
                2   => Payment Confirmed
                3   => Shipped Out
                4   => Received
                5   => Completed
                (0) => Cancelled
            */
            $table->enum('status', ['cancelled', 'completed', 'order_placed', 'payment_confirmed', 'received', 'shipped_out'])->default('order_placed');
            $table->timestamp('date_payment_confirmed')->nullable();
            $table->timestamp('date_shipped_out')->nullable();
            $table->timestamp('date_received')->nullable();
            $table->timestamp('date_completed')->nullable();
            $table->timestamp('date_cancelled')->nullable();
            $table->longtext('cancelation_reason')->nullable();
            $table->longtext('note')->nullable();
            $table->string('key_token')->unique();
            $table->timestamps();
            
            $table->foreign('billing_id')->references('id')->on('billings')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('restrict')->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['billing_id']);
            $table->dropColumn('billing_id');
            $table->dropForeign(['partner_id']);
            $table->dropColumn('partner_id');
        });
        Schema::dropIfExists('orders');
    }
}
