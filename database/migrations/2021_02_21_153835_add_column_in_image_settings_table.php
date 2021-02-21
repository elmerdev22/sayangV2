<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInImageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('image_settings', function (Blueprint $table) {
            $table->string('settings_key')->after('settings_group')->nullable()->unique();
            $table->string('redirect')->nullable()->after('arrangement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('image_settings', function (Blueprint $table) {
            //
        });
    }
}
