<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxIrrigationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_irrigation', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('irrigation_id')->nullable();
            $table->foreign('irrigation_id')->references('id')->on('irrigation')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('box_id');
            $table->foreign('box_id')->references('id')->on('boxes')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('box_irrigation');
    }
}
