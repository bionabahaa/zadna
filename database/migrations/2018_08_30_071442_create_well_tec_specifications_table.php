<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWellTecSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('well_tec_specifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('well_id');
            $table->foreign('well_id')->references('id')->on('wells')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('code')->unique();
            $table->integer('length')->nullable();
            $table->integer('type')->nullable();
            $table->longText('desc')->nullable();
            $table->integer('ability')->nullable();
            $table->integer('diameter')->nullable();
            $table->boolean('tec_type')->nullable();
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
        Schema::dropIfExists('well_tec_specifications');
    }
}
