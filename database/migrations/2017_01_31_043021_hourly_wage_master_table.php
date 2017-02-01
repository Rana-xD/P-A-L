<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HourlyWageMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hourly_wage_master', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staff_id');
            $table->double('hourly_wage/daytime',6,2);
            $table->double('hourly_wage/daytime_over_time',6,2);
            $table->double('hourly_wage/nighttime',6,2);
            $table->double('hourly_wage/nighttime_over_time',6,2);
            $table->date('Period_S');
            $table->date('Period_E');
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
        Schema::dropIfExists('hourly_wage_master');
    }
}
