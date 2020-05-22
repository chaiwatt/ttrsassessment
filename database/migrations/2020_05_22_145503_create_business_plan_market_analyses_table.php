<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPlanMarketAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_plan_market_analyses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_plan_id');
            $table->foreign('business_plan_id')->references('id')->on('business_plans')->onDelete('cascade');
            $table->text('condition')->comment('สภาวะอุตสาหกรรม และสภาวะตลาด')->nullable();
            $table->text('share')->comment('การแบ่งส่วนตลาด และส่วนแบ่งทางการตลาด')->nullable();
            $table->text('trend')->comment('แนวโน้มทางการตลาด')->nullable();
            $table->text('tarket')->comment('ตลาดเป้าหมาย')->nullable();
            $table->text('characteristicofcustomer')->comment('ลักษณะทั่วไปของลูกค้า')->nullable();
            $table->text('competition')->comment('สภาพการแข่งขัน')->nullable();
            $table->text('opponent')->comment('คู่แข่งขัน')->nullable();
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
        Schema::dropIfExists('business_plan_market_analyses');
    }
}
