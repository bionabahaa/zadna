<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DiseaseFollow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_follow', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->string('disease_code');
            $table->longText('note');
            $table->date('note_date');
            $table->integer('writen_by');
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
        Schema::dropIfExists('disease_follow');
    }
}
