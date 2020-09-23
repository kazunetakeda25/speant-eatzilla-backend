<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_partners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partner_id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->integer('service_zone');
            $table->string('password');
            $table->string('authToken');
            $table->string('device_token');
            $table->string('profile_pic');
            $table->tinyInteger('partner_commision');
            $table->string('license');
            $table->string('driving_license_no');
            $table->string('insurance');
            $table->string('rc_book');
            $table->date('expiry_date');
            $table->double('total_earnings',8,2);
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
        Schema::dropIfExists('delivery_partners');
    }
}
