<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCropsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('crops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->string('title')->nullable();
            $table->integer('qyt')->nullable();
            $table->longText('notes')->nullable();
            $table->date('date')->nullable();
            $table->unsignedInteger('crop_id')->nullable();
            $table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('crops');
    }
}
