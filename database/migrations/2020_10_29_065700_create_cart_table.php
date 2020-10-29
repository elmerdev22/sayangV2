<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_account_id')->index();
            $table->unsignedBigInteger('product_post_id')->index();
            $table->integer('quantity')->default(0);
            $table->string('key_token')->unique();
            $table->timestamps();

            $table->foreign('user_account_id')->references('id')->on('user_accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_post_id')->references('id')->on('product_posts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['user_account_id']);
            $table->dropColumn('user_account_id');
            $table->dropForeign(['product_post_id']);
            $table->dropColumn('product_post_id');
        });
        Schema::dropIfExists('cart');
    }
}
