<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullTbpMarketSwotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_tbp_market_swots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('full_tbp_id');
            $table->foreign('full_tbp_id')->references('id')->on('full_tbps')->onDelete('cascade');
            $table->longText('detail')->nullable();
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
        Schema::dropIfExists('full_tbp_market_swots');
    }
}
