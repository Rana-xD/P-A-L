<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ResultTable extends Migration
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
          $table->integer('division');
          $table->integer('area');
          $table->integer('location');
          $table->integer('year');
          $table->integer('month');
          $table->integer('revenue');
          $table->integer('cost');
          $table->integer('headoffice_expense');
          $table->integer('profit');
          $table->integer('profit_rate');
          $table->float('setting_rate',5,2);
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
