<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WorkShiftMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_shift_master', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staff_id');
            $table->tinyinteger('month');
            $table->tinyinteger('year');
            $table->string('work_shift',31);
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
        Schema::dropIfExists('work_shift_master');
    }
}
