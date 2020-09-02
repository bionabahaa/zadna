<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxSoilAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_soil_analysis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('box_id');
            $table->foreign('box_id')->references('id')->on('boxes')->onDelete('cascade')->onUpdate('cascade');
            $table->date('datetime')->nullable();
            $table->string('file')->nullable();
            $table->longText('note')->nullable();
            $table->longText('recommendation')->nullable();
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
        Schema::dropIfExists('box_soil_analysis');
    }
}
