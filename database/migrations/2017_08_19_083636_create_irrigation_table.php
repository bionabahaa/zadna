<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIrrigationTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('irrigation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->integer('signed')->default(0);
            $table->string('signed_file')->nullable();
            $table->string('title');
            $table->string('line_type');
            $table->string('water_amount');
            $table->string('cost')->default(0);
            $table->integer('lenght');
            $table->string('point1');
            $table->string('point2');
            $table->integer('diameter_half');
            $table->integer('water_speed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('irrigation');
    }
}
