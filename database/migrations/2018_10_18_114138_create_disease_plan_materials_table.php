<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiseasePlanMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_plan_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('disease_combact_plan_id');
            $table->foreign('disease_combact_plan_id')->references('id')->on('disease_combact_plan')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('pesticide');
            $table->foreign('pesticide')->references('id')->on('materials')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('amount');
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
        Schema::dropIfExists('disease_plan_materials');
    }
}
