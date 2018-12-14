<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('resized_featured_image')->nullable();
            $table->longText('description')->nullable();
//            $table->enum('location_type', [
//                \App\Models\Service::LOCATION_TYPE_IN,
//                \App\Models\Service::LOCATION_TYPE_EXCEPT,
//                \App\Models\Service::LOCATION_TYPE_ALL,
//                \App\Models\Service::LOCATION_TYPE_VIRTUAL,
//            ])->default(\App\Models\Service::LOCATION_TYPE_ALL);
            $table->timestamps();
        });

        Schema::create('service_location', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_id')->index();
            $table->unsignedInteger('location_id')->index();
            $table->string('location_type');

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_location', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
        });
        Schema::dropIfExists('service_location');
        Schema::dropIfExists('services');
    }
}
