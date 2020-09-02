<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->unsignedInteger('box_id');
            $table->foreign('box_id')->references('id')->on('boxes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->integer('experiment_type');
            $table->date('create_date');
            $table->time('execution_appointment');
            $table->integer('success_percent');
            $table->longText('palms');
            $table->date('execution_date');
            $table->string('alert_before_execution');
            $table->integer('alert_measure')->default(1);
            $table->longText('experiment_reason')->nullable();
            $table->longText('description')->nullable();


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
        Schema::dropIfExists('experiments');
    }
}
