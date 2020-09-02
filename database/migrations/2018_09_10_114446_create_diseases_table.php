<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiseasesTable extends Migration
{

    public function up()
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('desc');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('diseases');
    }
}
