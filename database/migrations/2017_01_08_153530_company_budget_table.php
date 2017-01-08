<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanyBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_budget', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('division');
            $table->integer('area');
            $table->integer('location');
            $table->integer('year');
            $table->integer('month');
            $table->integer('revenue');
            $table->integer('cost');
            $table->integer('profit');
            $table->integer('profit_rate');
            $table->integer('setting_rate');
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
        Schema::dropIfExists('company_budget');
    }
}
