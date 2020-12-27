<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_bids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->index();
            $table->unsignedBigInteger('bid_id')->index();            
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('bid_id')->references('id')->on('bids')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_bids', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['bid_id']);
            $table->dropColumn('order_id');
            $table->dropColumn('bid_id');
        });
        Schema::dropIfExists('order_bids');
    }
}
