<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('stockid');
            $table->string('batch');
            $table->string('stockkey');
            $table->integer('itemstocked');
            $table->integer('stockquantity');
            $table->integer('stockamount');
            $table->integer('stockprice');
            $table->integer('saleprice');
            $table->integer('projectedprofits');
            $table->integer('availablestock')->default(0);
             /////FK///////
             $table->integer('fkcompany')->unsigned();
             $table->foreign ('fkcompany')->references('id')->on('companies');
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
        Schema::dropIfExists('stocks');
    }
}
