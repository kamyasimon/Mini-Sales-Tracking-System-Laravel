<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investiments', function (Blueprint $table) {
            $table->id();
            $table->integer('workingcapital')->default(0);
            $table->integer('withdraws')->default(0);
            $table->integer('sales')->default(0);
            $table->integer('profits')->default(0);

             /////FK///////
             $table->integer('fkcompany')->unsigned();
             $table->foreign ('fkcompany')->references('id')->on('companies');
             $table->integer('fkadmin')->unsigned();
             $table->foreign ('fkadmin')->references('id')->on('users');
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
        Schema::dropIfExists('investiments');
    }
}
