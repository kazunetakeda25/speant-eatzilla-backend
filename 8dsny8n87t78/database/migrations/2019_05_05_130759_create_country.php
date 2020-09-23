<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('country', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country');
            $table->string('country_code');
            $table->string('currency_code');
            $table->string('currency_symbol');
            $table->tinyInteger('is_default')->default(0);
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
        //
        Schema::dropIfExists('country');
    }
}
