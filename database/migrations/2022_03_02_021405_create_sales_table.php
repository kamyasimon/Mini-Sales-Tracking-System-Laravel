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
            $table->string('company');
            $table->string('itemsold');
            $table->integer('quantitysold');
            $table->integer('amountsold');
            $table->string('customernumber')->default('N/A');
            $table->string('customername')->default('N/A');
            $table->string('expenditure')->nullable();
            $table->integer('expenditureamount')->default(0);
            $table->integer('totalprice');
            $table->string('orderstatus')->default('pending');//delivered OR paid

             /////FK///////
             $table->integer('fkuser')->unsigned();
             $table->foreign ('fkuser')->references('id')->on('users');

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
