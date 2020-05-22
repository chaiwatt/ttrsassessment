<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPlanHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_plan_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_plan_id');
            $table->foreign('business_plan_id')->references('id')->on('business_plans')->onDelete('cascade');
            $table->text('establishedhistory')->comment('ประวัติของกิจการ/ผู้เริ่มกิจการ')->nullable();
            $table->text('concepthistory')->comment('แนวความคิดในการก่อตั้งกิจการ')->nullable();
            $table->text('successhistory')->comment('ความสำเร็จที่ผ่านมา')->nullable();
            $table->text('obstaclehistory')->comment('อุปสรรคที่ผ่านมา')->nullable();
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
        Schema::dropIfExists('business_plan_histories');
    }
}
