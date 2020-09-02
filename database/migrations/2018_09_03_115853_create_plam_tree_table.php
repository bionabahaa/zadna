<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlamTreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plam_tree', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('crop_id');
            $table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('box_id');
            $table->foreign('box_id')->references('id')->on('boxes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('planting_id');
            $table->foreign('planting_id')->references('id')->on('planting')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('row');
            $table->integer('column');
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
        Schema::dropIfExists('plam_tree');
    }
}
