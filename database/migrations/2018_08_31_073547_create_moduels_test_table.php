<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuelsTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moduels_test', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('title')->nullable();
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('moduel_id');
            $table->integer('code')->unique();
            $table->integer('test_num')->nullable();
            $table->integer('test_duration')->nullable();
            $table->integer('extension')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('moduels_test');
    }
}
