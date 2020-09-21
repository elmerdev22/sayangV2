<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_bank_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('partner_id')->index();
            $table->unsignedBigInteger('bank_id')->index();
            $table->string('account_name');
            $table->string('account_no');
            $table->string('key_token')->unique();
            $table->timestamps();

            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('partner_bank_accounts', function (Blueprint $table){
            $table->dropForeign(['partner_id']);
            $table->dropForeign(['bank_id']);
        });
        Schema::dropIfExists('partner_bank_accounts');
    }
}
