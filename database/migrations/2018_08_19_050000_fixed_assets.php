<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixedAssets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FixedAssets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->unsignedInteger('fixedasset_type_id');
            $table->string('title');
            $table->text('desc')->nullable();
            $table->text('note')->nullable();
            $table->integer('Purchasing_value');
            $table->integer('Market_value');
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
        Schema::dropIfExists('FixedAssets');
    }
}
