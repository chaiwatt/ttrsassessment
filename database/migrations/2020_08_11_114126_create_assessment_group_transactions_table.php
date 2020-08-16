<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentGroupTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_group_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assessment_group_id');
            $table->foreign('assessment_group_id')->references('id')->on('assessment_groups')->onDelete('cascade');
            $table->unsignedBigInteger('cluster_id')->nullable();
            $table->unsignedBigInteger('sub_cluster_id')->nullable();
            $table->float('sub_cluster_weight')->nullable();
            $table->unsignedBigInteger('extrafactor_id')->nullable();
            $table->float('extrafactor_score')->nullable();
            $table->unsignedBigInteger('sub_extrafactor_id')->nullable();
            $table->float('sub_extrafactor_score')->nullable();
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
        Schema::dropIfExists('assessment_group_transactions');
    }
}
