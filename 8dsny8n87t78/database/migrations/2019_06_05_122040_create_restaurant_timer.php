<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantTimer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_timer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('restaurant_id');
            $table->dateTime('opening_time');
            $table->dateTime('closing_time');  
            $table->tinyInteger('is_weekend')->default(0);  
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
        Schema::dropIfExists('restaurant_timer');
    }
}
