<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntersectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intersection', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('irrigation_id');
            $table->foreign('irrigation_id')->references('id')->on('irrigation')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('line_type_id')->nullable();
            $table->string('coordinates');
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
        Schema::dropIfExists('intersection');
    }
}
