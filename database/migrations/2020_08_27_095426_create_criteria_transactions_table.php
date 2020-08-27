<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriaTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criteria_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ev_id');
            $table->foreign('ev_id')->references('id')->on('evs')->onDelete('cascade');
            $table->unsignedBigInteger('index_type_id');
            $table->unsignedBigInteger('sub_pillar_index_id');
            $table->unsignedBigInteger('criteria_id')->nullable();
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
        Schema::dropIfExists('criteria_transactions');
    }
}
