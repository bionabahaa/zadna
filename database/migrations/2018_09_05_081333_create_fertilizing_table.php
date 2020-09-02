<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFertilizingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fertilizing', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code')->unique();
            $table->unsignedInteger('box_id');
            $table->foreign('box_id')->references('id')->on('boxes')->onDelete('cascade')->onUpdate('cascade');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('used_type_id')->nullable();
            $table->integer('palm_tree_QYT')->nullable();
            $table->unsignedInteger('matrial_id')->nullable();
            $table->foreign('matrial_id')->references('id')->on('materials')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('fertilizer_QYT')->nullable();
            $table->longText('notes')->nullable();
            $table->longText('palm_tree')->nullable();
            $table->integer('level_id')->defult(1);
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
        Schema::dropIfExists('fertilizing');
    }
}
