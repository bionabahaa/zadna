<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIrrigationMahbasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irrigation_mahbas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('irrigation_id');
            $table->foreign('irrigation_id')->references('id')->on('irrigation')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('code');
            $table->string('location');
            $table->longText('desc')->nullable();

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
        Schema::dropIfExists('irrigation_mahbas');
    }
}
