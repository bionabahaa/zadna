<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaultTable extends Migration
{

    public function up()
    {
        Schema::create('faults', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->string('fault_code');
            $table->longText('desc')->nullable();
            $table->date('date');
            $table->integer('fault_status')->default(0);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('faults');
    }
}
