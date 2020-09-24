<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhilippineProvincesTmpTable extends Migration
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
            $table->string('psgc_code');
            $table->string('province_description');
            $table->string('region_code');
            $table->string('province_code');
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
        Schema::dropIfExists('philippine_provinces_tmp');
    }
}
