<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullTbpEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_tbp_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_plan_id');
            $table->foreign('business_plan_id')->references('id')->on('business_plans')->onDelete('cascade');
            $table->unsignedBigInteger('mini_tbp_id');
            $table->string('department',150)->nullable();
            $table->char('quantity',2)->nullable();
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
        Schema::dropIfExists('full_tbp_employees');
    }
}
