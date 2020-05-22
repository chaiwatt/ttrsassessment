<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPlanPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_plan_performances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_plan_id');
            $table->foreign('business_plan_id')->references('id')->on('business_plans')->onDelete('cascade');
            $table->char('year',4)->comment('ปี เช่น 2563')->nullable();
            $table->double('income',15,2)->comment('ยอดรายได้')->nullable();
            $table->double('netprofit',15,2)->comment('กำไรสุทธิ')->nullable();
            $table->double('totalasset',15,2)->comment('สินทรัพย์รวม')->nullable();
            $table->double('totalliability',15,2)->comment('หนี้สินรวม')->nullable();
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
        Schema::dropIfExists('business_plan_performances');
    }
}
