<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryPartnerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_partner_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('delivery_partners_id');
            $table->integer('city');
            $table->integer('vehicle_name');
            $table->text('address_line_1');
            $table->text('address_line_2');
            $table->string('address_city');
            $table->string('state_province');
            $table->string('country');
            $table->string('zip_code');
            $table->text('about');
            $table->string('account_name');
            $table->string('account_address');
            $table->string('account_no');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('branch_address');
            $table->string('swift_code');
            $table->string('routing_no');
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
        Schema::dropIfExists('delivery_partner_details');
    }
}
