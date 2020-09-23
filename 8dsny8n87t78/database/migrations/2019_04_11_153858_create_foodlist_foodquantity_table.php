<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodlistFoodquantityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foodlist_foodquantity', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('foodlist_id');
            $table->integer('foodquantity_id');
            $table->double('price',8,2);
            $table->tinyInteger('is_default');
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
        Schema::dropIfExists('foodlist_foodquantity');
    }
}
