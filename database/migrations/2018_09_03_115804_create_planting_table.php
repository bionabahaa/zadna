<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planting', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code')->unique();
            $table->integer('type_id');
            $table->unsignedInteger('box_id');
            $table->foreign('box_id')->references('id')->on('boxes')->onDelete('cascade')->onUpdate('cascade');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedInteger('fertlize_crop_id');
            $table->foreign('fertlize_crop_id')->references('id')->on('crops')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('protection_user_id');
            $table->foreign('protection_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('irrigation_user_id');
            $table->foreign('irrigation_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('planting');
    }
}
