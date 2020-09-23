<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_city', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->string('city');
            $table->string('admin_commission');
            $table->string('default_delivery_amount');
            $table->string('target_amount');
            $table->string('driver_base_price');
            $table->string('min_dist_base_price');
            $table->string('extra_fee_amount');
            $table->string('extra_fee_amount_each');
            $table->string('night_fare_amount');
            $table->string('night_driver_share');
            $table->string('surge_fare_amount');
            $table->string('surge_driver_share');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('add_city');
    }
}
