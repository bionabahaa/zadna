<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCropBoxTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('crop_box', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('crop_id');
            $table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('box_id');
            $table->foreign('box_id')->references('id')->on('boxes')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('crop_box');
    }
}
