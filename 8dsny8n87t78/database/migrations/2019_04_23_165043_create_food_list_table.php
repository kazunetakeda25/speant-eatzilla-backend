<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_list', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('restaurant_id');
            $table->integer('category_id');
            $table->integer('menu_id');
            $table->string('name');
            $table->double('price',8,2);
            $table->double('tax',8,2);
            $table->double('packaging_charge',8,2);
            $table->string('image');
            $table->text('description');
            $table->tinyinteger('is_veg');
            $table->tinyinteger('status');
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
        Schema::dropIfExists('food_list');
    }
}
