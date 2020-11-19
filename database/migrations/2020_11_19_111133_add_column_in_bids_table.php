<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddColumnInBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* 
            If the datatype of column is "enum" make the values is in 
            alphabetically ascending order to avoid the issue in filter of enum columns. 
        */
        DB::statement("ALTER TABLE bids MODIFY COLUMN status ENUM('active', 'lose', 'sold_out', 'win')");
        Schema::table('bids', function (Blueprint $table) {
            $table->enum('winning_status', ['cancelled', 'not_paid', 'paid'])->after('status')->default('not_paid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bids', function (Blueprint $table) {
            //
        });
    }
}
