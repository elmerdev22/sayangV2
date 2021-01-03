<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpCentreAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_centre_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('help_centre_question_id')->index();
            $table->longText('answer');
            $table->boolean('is_display')->default(true);
            $table->timestamps();

            $table->foreign('help_centre_question_id')->references('id')->on('help_centre_questions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('help_centre_answers', function (Blueprint $table) {
            $table->dropForeign(['help_centre_question_id']);
            $table->dropColumn('help_centre_question_id');
        });
        Schema::dropIfExists('help_centre_answers');
    }
}
