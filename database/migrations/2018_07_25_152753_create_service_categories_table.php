<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('resized_featured_image')->nullable();
            $table->string('featured_image')->nullable();
            $table->timestamps();
        });


        Schema::create('service_category', function (Blueprint $table) {
            $table->unsignedInteger('service_id')->index();
            $table->unsignedInteger('category_id')->index();

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('service_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_category', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('service_category');
        Schema::dropIfExists('service_categories');
    }
}
