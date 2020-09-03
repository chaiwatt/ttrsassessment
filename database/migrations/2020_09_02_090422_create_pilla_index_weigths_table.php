<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePillaIndexWeigthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pilla_index_weigths', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ev_id');
            $table->foreign('ev_id')->references('id')->on('evs')->onDelete('cascade');
            $table->unsignedBigInteger('sub_pillar_index_id');
            $table->float('weigth')->default(0);
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
        Schema::dropIfExists('pilla_index_weigths');
    }
}
