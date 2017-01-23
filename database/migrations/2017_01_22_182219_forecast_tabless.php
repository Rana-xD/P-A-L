<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForecastTabless extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_forecast', function (Blueprint $table) {
          $table->increments('id');
               $table->integer('division');
               $table->integer('area');
               $table->integer('location');
               $table->integer('year');
               $table->integer('month');
               $table->integer('revenue');
               $table->integer('cost');
               $table->integer('profit');
               $table->float('profit_rate',5,2);
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
        Schema::dropIfExists('location_forecast');
    }
}
