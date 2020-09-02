<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DiseaseCombactPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_combact_plan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('disease_id');
            $table->foreign('disease_id')->references('id')->on('diseases')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('code');
            $table->string('used_way');
            $table->integer('repeat');
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
        Schema::dropIfExists('disease_combact_plan');
    }
}
