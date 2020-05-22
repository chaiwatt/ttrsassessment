<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPlanMarketOpponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_plan_market_opponents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_plan_id');
            $table->foreign('business_plan_id')->references('id')->on('business_plans')->onDelete('cascade');
            $table->string('detail',250)->comment('ธุรกิจของเรา เช่น ราคาหรือคะแนน')->nullable();
            $table->string('opponentdetail',250)->comment('ธุรกิจของคู่แข่ง เช่น ราคาหรือคะแนน')->nullable();
            $table->string('opponentname',250)->comment('ชื่อคู่แข่ง')->nullable();
            $table->string('service',250)->comment('ด้านบริการ')->nullable();
            $table->string('price',250)->comment('ด้านราคา')->nullable();
            $table->string('distributionchannel',250)->comment('ด้านช่องทางการจัดจำหน่าย')->nullable();
            $table->string('promotemarketing',250)->comment('ด้านส่งเสริมการตลาด')->nullable();
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
        Schema::dropIfExists('business_plan_market_opponents');
    }
}
