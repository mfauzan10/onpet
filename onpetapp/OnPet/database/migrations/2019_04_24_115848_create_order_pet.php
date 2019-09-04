<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_pet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_customer');
            $table->integer('id_pet');
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
        Schema::dropIfExists('order_pet');
    }
}
