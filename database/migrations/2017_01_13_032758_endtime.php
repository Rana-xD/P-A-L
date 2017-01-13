<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Endtime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endtime', function (Blueprint $table) {
          $table->increments('id');
                $table->integer('location');
                $table->date('date');
                $table->tinyinteger('shift_type')->nullable();
                $table->string('end_time_1');
                $table->string('end_time_2');
                $table->string('end_time_3');
                $table->string('end_time_4');
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
        Schema::dropIfExists('endtime');
    }
}
