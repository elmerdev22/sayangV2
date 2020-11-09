<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('partner_id')->index();
            $table->unsignedBigInteger('user_account_id')->index();
            $table->boolean('is_notify')->default(false);
            $table->timestamps();

            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_account_id')->references('id')->on('user_accounts')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('followers', function (Blueprint $table) {
            $table->dropForeign(['user_account_id']);
            $table->dropForeign(['partner_id']);
            $table->dropColumn('user_account_id');
            $table->dropColumn('partner_id');
        });
        Schema::dropIfExists('followers');
    }
}
