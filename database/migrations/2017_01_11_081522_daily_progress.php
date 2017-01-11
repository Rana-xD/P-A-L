<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DailyProgress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_progress', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('location');
          $table->date('date');
          $table->integer('client')->nullable();
          $table->integer('category');
          $table->integer('quantity');
          $table->integer('price');
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
        Schema::dropIfExists('daily_progress');
    }
}
