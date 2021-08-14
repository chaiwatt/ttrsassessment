<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullTbpProjectPlanTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_tbp_project_plan_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_plan_id');
            $table->foreign('project_plan_id')->references('id')->on('full_tbp_project_plans')->onDelete('cascade');
            $table->unsignedBigInteger('full_tbp_id');
            $table->char('month',2);
            $table->char('mindex',2)->nullable();
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
        Schema::dropIfExists('full_tbp_project_plan_transactions');
    }
}
