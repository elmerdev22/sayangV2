<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerRepresentativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_representatives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('partner_id')->index();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('designation');
            $table->string('email');
            $table->string('contact_no', 11);
            $table->string('uploaded_id_file')->nullable();
            $table->string('uploaded_id_file_name')->nullable();
            $table->string('key_token')->unique();
            $table->timestamps();

            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partner_representatives', function (Blueprint $table){
            $table->dropForeign(['partner_id']);
        });
        Schema::dropIfExists('partner_representatives');
    }
}
