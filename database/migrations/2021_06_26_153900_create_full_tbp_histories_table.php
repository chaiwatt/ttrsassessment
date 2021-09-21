<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullTbpHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_tbp_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('full_tbp_id');
            $table->foreign('full_tbp_id')->references('id')->on('full_tbps')->onDelete('cascade');
            $table->unsignedBigInteger('revise_log_id')->nullable();
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
        Schema::dropIfExists('full_tbp_histories');
    }
}
