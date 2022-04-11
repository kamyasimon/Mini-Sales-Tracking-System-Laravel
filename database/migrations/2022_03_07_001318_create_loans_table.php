<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('customername')->default('N/A');
            $table->string('customernumber');
            $table->integer('amountloaned');
            $table->integer('amountpaid')->default(0);
            $table->integer('amountbalance')->default(0);
            $table->string('loanstatus')->default('notpaid');
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
        Schema::dropIfExists('loans');
    }
}
