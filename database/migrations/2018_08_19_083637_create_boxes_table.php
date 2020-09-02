<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('boxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('crop_id');
            $table->string('code');
            $table->string('row');
            $table->string('column');
            $table->integer('signed')->default(0);
            $table->string('signed_file')->nullable();
            $table->string('point1')->nullable();
            $table->string('point2')->nullable();
            $table->string('point3')->nullable();
            $table->string('point4')->nullable();
            $table->string('size')->nullable();
            $table->integer('column_count')->nullable();
            $table->integer('row_count')->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('boxes');
    }
}
