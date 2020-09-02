<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeparationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('separation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code')->unique();
            $table->unsignedInteger('box_id');
            $table->foreign('box_id')->references('id')->on('boxes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('crop_id');
            $table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade')->onUpdate('cascade');
            $table->string('plam_tree')->nullable();
            $table->string('crops_in_box')->nullable();
            $table->string('size')->nullable();
            $table->string('market_price')->nullable();
            $table->date('start_date')->nullable();
            $table->integer('number_of_separation')->nullable();
            $table->integer('case')->nullable();
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
        Schema::dropIfExists('separation');
    }
}
