<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class ChangeColumnInImageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('image_settings', function (Blueprint $table) {
            DB::statement('ALTER TABLE image_settings MODIFY redirect TEXT;');
            $table->longtext('description')->nullable()->after('redirect');
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
