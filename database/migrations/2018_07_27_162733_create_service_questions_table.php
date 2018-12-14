<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('question')->nullable();
            $table->enum('type', [
                \App\Models\ServiceQuestion::TYPE_BOOLEAN,
                \App\Models\ServiceQuestion::TYPE_TEXT,
                \App\Models\ServiceQuestion::TYPE_TEXT_MULTILINE,
                \App\Models\ServiceQuestion::TYPE_SELECT,
                \App\Models\ServiceQuestion::TYPE_SELECT_MULTIPLE,
                \App\Models\ServiceQuestion::TYPE_DATE,
                \App\Models\ServiceQuestion::TYPE_TIME,
                \App\Models\ServiceQuestion::TYPE_DATE_TIME,
                \App\Models\ServiceQuestion::TYPE_FILE,
                \App\Models\ServiceQuestion::TYPE_FILE_MULTIPLE,
            ])->default(App\Models\ServiceQuestion::TYPE_TEXT);
            $table->boolean('is_locked')->default(false);
            $table->timestamps();

        });

        Schema::create('service_question', function (Blueprint $table) {
            $table->unsignedInteger('service_id')->index();
            $table->unsignedInteger('question_id')->index();

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
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
        Schema::table('service_question', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropForeign(['question_id']);
        });
        Schema::dropIfExists('service_question');
        Schema::dropIfExists('service_questions');
    }
}
