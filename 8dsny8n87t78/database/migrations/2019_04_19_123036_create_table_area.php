<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_area', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('add_city_id');
            $table->string('area');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('add_area');
    }
}
