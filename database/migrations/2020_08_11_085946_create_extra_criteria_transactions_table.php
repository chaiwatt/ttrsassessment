<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraCriteriaTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_criteria_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ev_id');
            $table->foreign('ev_id')->references('id')->on('evs')->onDelete('cascade');
            $table->unsignedBigInteger('extra_category_id');
            $table->unsignedBigInteger('extra_criteria_id');
            $table->double('weight',10,5)->default(0);
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
        Schema::dropIfExists('extra_criteria_transactions');
    }
}
