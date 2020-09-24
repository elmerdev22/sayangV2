<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhilippineProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('philippine_provinces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('region_id')->index();
            $table->string('psgc_code');
            $table->string('name');
            $table->string('code');
            $table->timestamps();

            $table->foreign('region_id')->references('id')->on('philippine_regions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('philippine_provinces', function (Blueprint $table){
            $table->dropForeign(['region_id']);
        });
        Schema::dropIfExists('philippine_provinces');
    }
}
