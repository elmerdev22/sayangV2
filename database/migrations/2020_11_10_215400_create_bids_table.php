<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bid_no', 255)->unique();
            $table->unsignedBigInteger('product_post_id')->index();
            $table->unsignedBigInteger('user_account_id')->index();
            $table->decimal('bid', 11,2)->nullable()->default(0);
            $table->integer('quantity')->default(0);
            $table->enum('status', ['active', 'win', 'lose']);
            $table->string('key_token')->unique();
            $table->timestamps();
            
            $table->foreign('product_post_id')->references('id')->on('product_posts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_account_id')->references('id')->on('user_accounts')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bids', function (Blueprint $table) {
            $table->dropForeign(['product_post_id']);
            $table->dropForeign(['user_account_id']);
            $table->dropColumn('product_post_id');
            $table->dropColumn('user_account_id');
        });
        Schema::dropIfExists('bids');
    }
}
