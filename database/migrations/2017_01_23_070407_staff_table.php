<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('staff_name',250)->nullable();
            $table->integer('location')->nullable();
            $table->date('retirement_date')->nullable();
            $table->tinyinteger('work_shift')->nullable();
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
        Schema::dropIfExists('staff_master');
    }
}
