<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperimentExecuteStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiment_execute_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->unsignedInteger('experiment_id');
            $table->foreign('experiment_id')->references('id')->on('experiments')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('description')->nullable();
            $table->longText('recommendation')->nullable();
            $table->date('date');
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
        Schema::dropIfExists('experiment_execute_steps');
    }
}
