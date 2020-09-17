<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAdminRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_admin_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_admin_id')->index();
            $table->unsignedBigInteger('role_type_id')->index();
            $table->timestamps();

            $table->foreign('user_admin_id')->references('id')->on('user_admins')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('role_type_id')->references('id')->on('user_admin_role_types')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_admin_roles', function (Blueprint $table){
            $table->dropForeign(['user_admin_id']);
            $table->dropForeign(['role_type_id']);
        });
        
        Schema::dropIfExists('user_admin_roles');
    }
}
