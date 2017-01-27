<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AccidentsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accident', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('location');
          $table->date('date');
          $table->integer('accident');
          $table->integer('#of_quantity_tobuy');
          $table->double('amount',12,2);
          $table->string('comment',500);
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
        Schema::dropIfExists('accident');
    }
}
