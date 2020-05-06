<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriaGroupTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criteria_group_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('criteria_group_id');
            $table->foreign('criteria_group_id')->references('id')->on('criteria_groups')->onDelete('cascade');
            $table->unsignedBigInteger('criteria_id');
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
        Schema::dropIfExists('criteria_group_transactions');
    }
}
