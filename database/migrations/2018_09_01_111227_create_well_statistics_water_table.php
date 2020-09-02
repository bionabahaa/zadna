<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWellStatisticsWaterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('well_statistics_water', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('well_id');
            $table->foreign('well_id')->references('id')->on('wells')->onDelete('cascade')->onUpdate('cascade');
            $table->date('datetime')->nullable();
            $table->string('file')->nullable();
            $table->integer('qyt')->nullable();
            $table->boolean('statistics_type');
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
        Schema::dropIfExists('well_statistics_water');
    }
}
