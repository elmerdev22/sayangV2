<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalColumnsInProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->Integer('weight')->nullable()->after('slug');
            $table->string('length')->nullable()->after('weight');
            $table->string('width')->nullable()->after('length');
            $table->string('height')->nullable()->after('width');
            $table->Integer('shelf_life')->nullable()->after('height');
            $table->boolean('paper_packaging')->default(false)->after('shelf_life');
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
            //
        });
    }
}
