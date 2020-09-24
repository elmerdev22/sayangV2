<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhilippineBarangaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('philippine_barangays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('city_id')->index();
            $table->string('name');
            $table->string('code');
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('philippine_cities')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('philippine_barangays', function (Blueprint $table){
            $table->dropForeign(['city_id']);
        });
        Schema::dropIfExists('philippine_barangays');
    }
}
