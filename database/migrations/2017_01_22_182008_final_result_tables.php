<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FinalResultTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_result', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('division')->nullable();
          $table->integer('area')->nullable();
          $table->integer('location')->nullable();
          $table->integer('year')->nullable();
          $table->integer('month')->nullable();
          $table->integer('revenue')->nullable();
          $table->integer('cost')->nullable();
          $table->integer('headoffice_expense')->nullable();
          $table->integer('profit')->nullable()->nullable();
          $table->float('profit_rate',5,2)->nullable();
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
        Schema::dropIfExists('final_result');
    }
}
