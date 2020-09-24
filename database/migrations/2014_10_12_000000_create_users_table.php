<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('email')->nullable()->unique();
            $table->enum('provider', ['default', 'facebook', 'google'])->default('default')->nullable();
            $table->string('provider_id')->nullable();
            $table->enum('type', ['admin', 'user', 'partner']);
            $table->enum('verification_type', ['email', 'sms'])->default('email');
            $table->string('verification_code', 10)->nullable()->default(null);
            $table->timestamp('verification_expired_at')->nullable()->default(null);
            $table->timestamp('verified_at')->nullable()->default(null);
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('key_token')->unique();
            $table->boolean('is_blocked')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
