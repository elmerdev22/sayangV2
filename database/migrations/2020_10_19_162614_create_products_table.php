<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('partner_id')->index();
            $table->unsignedBigInteger('category_id')->index();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->text('reminders')->nullable();
            $table->decimal('buy_now_price', 11,2)->nullable()->default(0);
            $table->decimal('lowest_price', 11,2)->nullable()->default(0);
            $table->string('slug')->unique();
            $table->string('key_token')->unique();
            $table->boolean('is_posted')->default(true)->nullable();
            $table->timestamps();

            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->dropForeign(['partner_id']);
            $table->dropColumn('partner_id');
        });
        Schema::dropIfExists('products');
    }
}
