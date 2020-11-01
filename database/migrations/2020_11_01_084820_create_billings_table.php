<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_account_id')->index();
            $table->unsignedBigInteger('barangay_id')->index();
            $table->string('billing_no', 255)->unique();
            $table->string('full_name', 500);
            $table->string('contact_no', 11)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('addresses', 500)->nullable();
            $table->string('zip_code', 10)->nullable();
            $table->longtext('note')->nullable();
            $table->string('key_token')->unique();
            $table->timestamps();

            $table->foreign('user_account_id')->references('id')->on('user_accounts')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::table('billings', function (Blueprint $table) {
            $table->dropForeign(['user_account_id']);
            $table->dropColumn('user_account_id');
            $table->dropForeign(['barangay_id']);
            $table->dropColumn('barangay_id');
        });
        Schema::dropIfExists('billings');
    }
}
