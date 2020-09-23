<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers_banner', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('restaurant_id');
            $table->string('image');
            $table->string('title');
            $table->text('description');
            $table->tinyInteger('position');
            $table->tinyInteger('status');
            $table->tinyInteger('is_suffle');
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
        Schema::dropIfExists('offers_banner');
    }
}
