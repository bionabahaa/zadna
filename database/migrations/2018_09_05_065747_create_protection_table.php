<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protection', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code')->unique();
            $table->unsignedInteger('box_id');
            $table->foreign('box_id')->references('id')->on('boxes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('Pesticide_QYT')->nullable();
            $table-> unsignedInteger('matrial_id')->nullable();
            $table->foreign('matrial_id')->references('id')->on('materials')->onDelete('cascade')->onUpdate('cascade');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->longText('palm_tree')->nullable();
            $table->integer('palm_tree_QYT')->nullable();
            $table->integer('used_type_id')->nullable();
            $table->longText('recommendation')->nullable();
            $table->integer('implementation')->default(1);
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
        Schema::dropIfExists('protection');
    }
}
