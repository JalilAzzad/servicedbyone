<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_id')->index();
            $table->unsignedInteger('user_id')->index()->nullable();
            $table->unsignedInteger('city_area_id')->index()->nullable();
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('city_area_id')->references('id')->on('city_areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['city_area_id']);
        });
        Schema::dropIfExists('service_requests');
    }
}
