<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanningIrrigationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planning_irrigation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->unsignedInteger('irrigation_id')->nullable();
            $table->foreign('irrigation_id')->references('id')->on('irrigation_mahbas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('planting_id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('qyt')->nullable();
            $table->integer('repeat')->nullable();
            $table->date('irrigation_date')->nullable();
            $table->longText('note')->nullable();
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
        Schema::dropIfExists('planning_irrigation');
    }
}
