<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectStatusTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_status_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mini_tbp_id');
            $table->foreign('mini_tbp_id')->references('id')->on('mini_t_b_p_s')->onDelete('cascade');
            $table->unsignedBigInteger('project_flow_id');
            $table->char('status',1)->default(1);
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
        Schema::dropIfExists('project_status_transactions');
    }
}
