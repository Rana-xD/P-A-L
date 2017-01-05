<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnitPriceMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_price_master', function (Blueprint $table) {
          $table->increments('uop_id');
                $table->integer('location_id');
                $table->string('client',3);
                $table->integer('category');
                $table->string('price_type_name',80);
                $table->integer('UOP');
                $table->date('Period_S')->nullable();
                $table->date('Period_E')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_price_master');
    }
}
