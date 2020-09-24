<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhilippineCitiesTmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('philippine_cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('psgc_code');
            $table->string('city_municipality_description');
            $table->string('region_description');
            $table->string('province_code');
            $table->string('city_municipality_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('philippine_cities_tmp');
    }
}
