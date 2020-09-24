<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->UnsignedBigInteger('parent_category_id')->index()->nullable();
            $table->string('name')->unique();
            $table->string('key_token')->unique()->nullable();
            $table->string('slug')->unique()->nullable();
            $table->timestamps();
            
            $table->foreign('parent_category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table){
            $table->dropForeign(['parent_category_id']);
        });
        Schema::dropIfExists('categories');
    }
}
