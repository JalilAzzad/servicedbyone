<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceQuestionValidationRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_question_validation_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rule');
            $table->string('html_rule')->nullable();
            $table->string('laravel_rule')->nullable();
            $table->boolean('is_custom_laravel_rule')->default(false);
            $table->boolean('has_value')->default(false);
            $table->timestamps();
        });


        Schema::create('service_question_validation_rule', function (Blueprint $table) {
            $table->unsignedInteger('rule_id')->index();
            $table->unsignedInteger('question_id')->index();
            $table->integer('value')->nullable();

            $table->foreign('rule_id')->references('id')->on('service_question_validation_rules')->onDelete('cascade');
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
        Schema::table('service_question_validation_rule', function (Blueprint $table) {
            $table->dropForeign(['rule_id']);
            $table->dropForeign(['question_id']);
        });
        Schema::dropIfExists('service_question_validation_rule');
        Schema::dropIfExists('service_question_validation_rules');
    }
}
