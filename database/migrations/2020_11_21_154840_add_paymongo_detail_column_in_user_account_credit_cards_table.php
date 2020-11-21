<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymongoDetailColumnInUserAccountCreditCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_account_credit_cards', function (Blueprint $table) {
            $table->string('paymongo_resource_id', 100)->after('user_account_id')->nullable();
            $table->string('paymongo_resource', 100)->after('paymongo_resource_id')->nullable();
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

        });
    }
}
