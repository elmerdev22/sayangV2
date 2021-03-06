<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_account_id')->index();
            $table->unsignedBigInteger('barangay_id')->index();
            $table->string('partner_no')->unique();
            $table->string('name');
            $table->string('address');
            $table->string('map_address_link', 500);
            $table->string('contact_no', 11);
            $table->string('email');
            $table->string('dti_registration_no');
            $table->string('tin');
            $table->string('dti_certificate_file')->nullable();
            $table->string('dti_certificate_file_name', 500)->nullable();
            $table->enum('status',['done', 'pending'])->default('pending');
            $table->boolean('is_posted')->default(true);
            $table->boolean('is_activated')->default(false);
            $table->date('date_activated')->nullable();
            $table->string('slug')->unique();
            $table->string('key_token')->unique();
            $table->timestamps();

            $table->foreign('user_account_id')->references('id')->on('user_accounts')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partners', function (Blueprint $table){
            $table->dropForeign(['user_account_id']);
        });
        Schema::dropIfExists('partners');
    }
}
