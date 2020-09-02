<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id');
            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('type_id')->default(1);
            $table->integer('blocked')->default(0)->nullable();
            $table->string('username')->unique();
            $table->string('password')->nullable();
            $table->string('email')->unique();
            $table->date('hiring_date')->nullable();
            $table->boolean('permission_login')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
