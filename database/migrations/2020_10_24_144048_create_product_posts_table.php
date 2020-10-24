<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->index();
            $table->decimal('buy_now_price', 11,2)->default(0.00);
            $table->decimal('lowest_price', 11,2)->default(0.00);
            $table->integer('quantity')->default(0);
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->enum('status', ['active', 'cancelled', 'done']);
            $table->boolean('is_set')->nullable()->default(false);
            $table->string('key_token')->unique();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_posts', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });
        Schema::dropIfExists('product_posts');
    }
}
