<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantPayoutHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('restaurant_payout_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('restaurant_id');
            $table->double('payout_amount',10,2);
            $table->string('transaction_id');
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
        //
        Schema::dropIfExists('restaurant_payout_history');
    }
}
