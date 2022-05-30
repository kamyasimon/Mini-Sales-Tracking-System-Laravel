<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->int('itemsold');
            $table->string('batch');
            $table->string('stockid');
            $table->integer('quantitysold');
            $table->integer('amountsold');
            $table->string('customernumber')->nullable();
            $table->string('customername')->nullable();
            $table->string('expenditure')->nullable();
            $table->integer('expenditureamount')->default(0);
            $table->integer('totalprice');
            $table->string('orderstatus')->default('pending');//delivered OR paid
            $table->BOOLEAN('handedover')->default(false);//if the recieving agent has received the money
             /////FK///////
             $table->integer('fkuser')->unsigned();
             $table->foreign ('fkuser')->references('id')->on('users');
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
        Schema::dropIfExists('sales');
    }
}
