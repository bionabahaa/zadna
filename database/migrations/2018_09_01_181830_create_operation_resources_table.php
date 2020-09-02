<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_resources', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('moduel_id');
            $table->unsignedInteger('opertion_type_id');
            $table->integer('code')->unique();
            $table->string('title')->nullable();
            $table->unsignedInteger('equipment_id')->nullable();
            $table->foreign('equipment_id')->references('id')->on('equipments')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('matrial_id')->nullable();
            $table->foreign('matrial_id')->references('id')->on('materials')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('box_id')->nullable();
            $table->foreign('box_id')->references('id')->on('boxes')->onDelete('cascade')->onUpdate('cascade');
            $table->date('datetime')->nullable();
            $table->date('datetime_end')->nullable();
            $table->integer('qyt')->nullable();
            $table->integer('sent_qyt')->nullable();
            $table->integer('rest_qyt')->nullable();
            $table->integer('cost')->nullable();
            $table->integer('expected_cost')->nullable();
            $table->integer('working_number_days')->nullable();
            $table->integer('working_number_hours_per_day')->nullable();
            $table->integer('workers_count')->nullable();
            $table->integer('hours_used')->nullable();
            $table->integer('workers_type_id')->nullable();
            $table->integer('store_done')->default(0);
            $table->string('palm_tree')->nullable();
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
        Schema::dropIfExists('operation_resources');
    }
}
