<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckListGradingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_list_gradings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ev_id');
            $table->foreign('ev_id')->references('id')->on('evs')->onDelete('cascade');
            $table->unsignedBigInteger('sub_pillar_index_id');
            $table->integer('gradea')->default(0);
            $table->integer('gradeb')->default(0);
            $table->integer('gradec')->default(0);
            $table->integer('graded')->default(0);
            $table->integer('gradee')->default(0);
            $table->integer('gradef')->default(0);
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
        Schema::dropIfExists('check_list_gradings');
    }
}
