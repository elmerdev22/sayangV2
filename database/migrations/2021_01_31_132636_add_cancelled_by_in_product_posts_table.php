<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCancelledByInProductPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_posts', function (Blueprint $table) {
            $table->text('cancellation_reason')->nullable()->after('date_cancelled');
            $table->enum('cancelled_by', ['admin','partner'])->nullable()->after('date_cancelled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_posts', function (Blueprint $table) {
            //
        });
    }
}
