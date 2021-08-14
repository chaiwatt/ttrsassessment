<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiniTbpHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mini_tbp_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mini_tbp_id');
            $table->foreign('mini_tbp_id')->references('id')->on('mini_t_b_p_s')->onDelete('cascade');
            $table->string('path',250)->nullable();
            $table->longText('message')->nullable();
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
        Schema::dropIfExists('mini_tbp_histories');
    }
}
