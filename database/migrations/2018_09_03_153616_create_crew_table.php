<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crew', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('crew_id')->nullable();
            $table->foreign('crew_id')->references('id')->on('crew')->onDelete('cascade')->onUpdate('cascade');
            $table->string('gender');
            $table->string('nationality');
            $table->bigInteger('national_id');
            $table->integer('day_work_num')->nullable();
            $table->integer('cost_by_day')->nullable();
            $table->text('phone')->nullable();
            $table->longText('process')->nullable();
            $table->integer('cost_by_month')->nullable();
            $table->integer('total_cost')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('crew');
    }
}
