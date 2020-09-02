<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wells', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('location')->nullable();
            $table->string('title');
            $table->boolean('status')->default(1);
            $table->integer('signed')->default(0);
            $table->string('signed_file')->nullable();
            $table->dateTime('date_of_excavation');
            $table->string('water_quantity_file')->nullable();
            $table->string('water_analysis_file')->nullable();
            $table->string('geological_profile_file')->nullable();
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
        Schema::dropIfExists('wells');
    }
}
