<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('vehicle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vehicle_name');
            $table->string('vehicle_no');
            $table->string('insurance_no');
            $table->string('insurance_image');
            $table->string('vehicle_image')->nullable();
            $table->string('insurance_expiry_date');
            $table->string('rc_no');
            $table->string('rc_name');
            $table->string('rc_image');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('vehicle');
    }
}
