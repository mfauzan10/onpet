<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderCare extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_care', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_care');
            $table->integer('id_customer');
            $table->date('startdate');
            $table->date('enddate');
            $table->string('information');
            $table->boolean('confirmed')->default(0);
            $table->boolean('status')->default(0);
            $table->boolean('purchased')->default(0);
            $table->string('testimoni')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_care');
    }
}
