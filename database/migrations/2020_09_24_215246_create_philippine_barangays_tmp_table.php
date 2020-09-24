<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhilippineBarangaysTmpTable extends Migration
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
            $table->string('barangay_code');
            $table->string('barangay_description');
            $table->string('region_code');
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
        Schema::dropIfExists('philippine_barangays_tmp');
    }
}
