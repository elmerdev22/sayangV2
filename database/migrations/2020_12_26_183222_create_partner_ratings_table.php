<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_account_id')->index();
            $table->unsignedBigInteger('partner_id')->index();
            $table->unsignedBigInteger('order_id')->index();
            $table->integer('star')->nullable();
            $table->string('rating')->nullable();
            $table->longText('comment')->nullable();
            $table->timestamps();
            
            $table->foreign('user_account_id')->references('id')->on('user_accounts')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partner_ratings', function (Blueprint $table){
            $table->dropForeign(['user_account_id']);
            $table->dropColumn('user_account_id');
            $table->dropForeign(['partner_id']);
            $table->dropColumn('partner_id');
            $table->dropForeign(['order_id']);
            $table->dropColumn('order_id');
        });
        Schema::dropIfExists('partner_ratings');
    }
}
