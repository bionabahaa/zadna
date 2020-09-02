<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiseasePalmTreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_palm_tree', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->unsignedInteger('disease_id');
            $table->foreign('disease_id')->references('id')->on('diseases')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('box_id');
            $table->foreign('box_id')->references('id')->on('boxes')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('plam_tree_id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('recovery_percent')->nullable();
            $table->longText('losses_reason')->nullable();
            $table->integer('status')->default(2)->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('disease_palm_tree');
    }
}
