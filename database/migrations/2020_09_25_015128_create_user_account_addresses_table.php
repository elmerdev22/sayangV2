<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccountAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_account_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_account_id')->index();
            $table->unsignedBigInteger('barangay_id')->index();
            $table->string('full_name');
            $table->string('contact_no', 11);
            $table->string('zip_code', 10);
            $table->string('address', 500);
            $table->boolean('is_default')->default(0);
            $table->timestamps();

            $table->foreign('user_account_id')->references('id')->on('user_accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('barangay_id')->references('id')->on('philippine_barangays')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_account_addresses', function (Blueprint $table){
            $table->dropForeign(['user_account_id']);
            $table->dropForeign(['barangay_id']);
        });
        Schema::dropIfExists('user_account_addresses');
    }
}
