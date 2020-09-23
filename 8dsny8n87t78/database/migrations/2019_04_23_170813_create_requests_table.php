<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('user_id');
            $table->integer('restaurant_id');
            $table->integer('delivery_boy_id');
            $table->double('item_total',6,2);
            $table->double('offer_discount',6,2);
            $table->double('restaurant_packaging_charge',6,2);
            $table->double('tax',6,2);
            $table->double('delivery_charge',6,2);
            $table->double('bill_amount',6,2);
            $table->double('admin_commision',6,2);
            $table->double('restaurant_commision',6,2);
            $table->double('delivery_boy_commision',6,2);
            $table->string('coupon_code');
            $table->tinyInteger('is_confirmed');
            $table->tinyInteger('is_paid');
            $table->tinyInteger('paid_type');
            $table->tinyInteger('status');
            $table->text('delivery_address');
            $table->string('d_lat');
            $table->string('d_lng');
            $table->dateTime('ordered_time');
            $table->dateTime('delivered_time');    
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
        Schema::dropIfExists('requests');
    }
}
