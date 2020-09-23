<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestdetailAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestdetail_addons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('requestdetail_id');
            $table->integer('addons_id');
            $table->string('name');
            $table->double('price',4,2);
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
        Schema::dropIfExists('requestdetail_addons');
    }
}
