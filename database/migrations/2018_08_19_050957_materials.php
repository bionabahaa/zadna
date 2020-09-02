<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Materials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('material_type_id');
            $table->unsignedInteger('material_unit_id');
            $table->foreign('material_unit_id')->references('id')->on('material_units')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('main_groub');
            $table->string('title');
            $table->string('cost');
            $table->string('code')->nullable();
            $table->integer('QYT');
            $table->text('note');
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
        Schema::dropIfExists('Materials');
    }
}
