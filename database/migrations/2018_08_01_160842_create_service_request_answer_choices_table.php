<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRequestAnswerChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_request_answer_choices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('choice_id')->index();

            $table->foreign('choice_id')->references('id')->on('service_question_choices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_request_answer_choices', function (Blueprint $table) {
            $table->dropForeign(['choice_id']);
        });
        Schema::dropIfExists('service_request_answer_choices');
    }
}
