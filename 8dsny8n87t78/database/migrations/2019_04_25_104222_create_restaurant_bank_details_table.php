<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_bank_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('restaurant_id');
            $table->string('account_name');
            $table->string('account_address');
            $table->string('account_no');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('branch_address');
            $table->string('swift_code')->nullable();
            $table->string('routing_no')->nullable();
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
        Schema::dropIfExists('restaurant_bank_details');
    }
}
