<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRequestAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_request_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('request_id')->index();
            $table->unsignedInteger('question_id')->index();
            $table->unsignedInteger('answer_id')->index();
            $table->string('answer_type');
            $table->timestamps();

            $table->foreign('request_id')->references('id')->on('service_requests')->onDelete('cascade');
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
        Schema::table('service_request_answers', function (Blueprint $table) {
            $table->dropForeign(['request_id']);
            $table->dropForeign(['question_id']);
        });
        Schema::dropIfExists('service_request_answers');
    }
}
