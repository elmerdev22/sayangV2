<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('settings_group');
            $table->string('settings_name');
            $table->boolean('is_display')->default(true);
            $table->integer('arrangement')->nullable();
            $table->string('key_token')->unique();
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
        Schema::dropIfExists('image_settings');
    }
}
