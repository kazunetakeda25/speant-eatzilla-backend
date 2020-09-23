<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityGeofencingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_geofencing', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id');
            $table->string('longitude');
            $table->string('latitude');
            $table->text('polygons');
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
        Schema::dropIfExists('city_geofencing');
    }
}
