<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_code', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('title');
            $table->string('description');
            $table->double('max_amount',6,2)->default(0);
            $table->tinyInteger('offer_type');
            $table->double('value',6,2);
            $table->date('available_from');
            $table->date('valid_till');
            $table->tinyInteger('use_per_customer');
            $table->tinyInteger('total_use');
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
        Schema::dropIfExists('coupon_code');
    }
}
