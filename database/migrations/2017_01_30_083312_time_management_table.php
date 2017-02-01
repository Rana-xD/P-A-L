<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TimeManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_management', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('staff');
            $table->integer('location');
            $table->tinyinteger('work_shift');
            $table->string('start_time',7);
            $table->string('end_time',7);
            $table->double('working_hour',5,2);
            $table->double('actual_working_hour',5,2);
            $table->double('overtime_working_hour',5,2);
            $table->string('process',300);
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
        Schema::dropIfExists('time_management');
    }
}
