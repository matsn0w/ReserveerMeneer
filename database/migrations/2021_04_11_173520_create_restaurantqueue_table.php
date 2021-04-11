<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantqueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_queues', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->constrained();
            $table->integer('restaurant_id')->constrained();
            $table->date('date');
            $table->time('time');
            $table->integer('groupsize');
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
        Schema::dropIfExists('restaurantqueue');
    }
}
