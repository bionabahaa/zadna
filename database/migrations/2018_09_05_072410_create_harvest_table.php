<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHarvestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harvest', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code')->unique();
            $table->unsignedInteger('box_id');
            $table->foreign('box_id')->references('id')->on('boxes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('crop_id');
            $table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date')->nullable();
            $table->integer('qyt')->nullable();
            $table->integer('row')->nullable();
            $table->integer('column')->nullable();
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
        Schema::dropIfExists('harvest');
    }
}
