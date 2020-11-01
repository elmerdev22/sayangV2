<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccountCreditCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_account_credit_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_account_id')->index();
            $table->string('card_holder', 255);
            $table->string('card_no', 50);
            $table->date('card_expiration_date');
            $table->string('card_verification_value');
            $table->boolean('is_default')->default(true);
            $table->string('key_token')->unique();
            $table->timestamps();

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
        Schema::table('user_account_credit_cards', function (Blueprint $table) {
            $table->dropForeign(['user_account_id']);
            $table->dropColumn('user_account_id');
        });
        Schema::dropIfExists('user_account_credit_cards');
    }
}
