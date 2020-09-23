<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('address');
            $table->string('lat');
            $table->string('lng');
            $table->string('flat_no');
            $table->string('landmark');
            $table->tinyInteger('is_default');
            $table->tinyInteger('type')->comment('1- Home, 2- Work, 3- Others');
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
        Schema::dropIfExists('delivery_address');
    }
}
