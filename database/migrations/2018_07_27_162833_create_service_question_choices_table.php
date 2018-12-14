<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceQuestionChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_question_choices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('question_id')->index();
            $table->string('choice');
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('service_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_question_choices', function (Blueprint $table) {
            $table->dropForeign(['question_id']);
        });
        Schema::dropIfExists('service_question_choices');
    }
}
