<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccountBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_account_banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_account_id')->index();
            $table->unsignedBigInteger('bank_id')->index();
            $table->string('account_name');
            $table->string('account_no');
            $table->boolean('is_default')->default(true);
            $table->string('key_token')->unique();
            $table->timestamps();

            $table->foreign('user_account_id')->references('id')->on('user_accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_account_banks', function (Blueprint $table) {
            $table->dropForeign(['user_account_id']);
            $table->dropColumn('user_account_id');
            $table->dropForeign(['bank_id']);
            $table->dropColumn('bank_id');
        });
        Schema::dropIfExists('user_account_banks');
    }
}
