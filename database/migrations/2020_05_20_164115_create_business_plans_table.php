<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_plans', function (Blueprint $table) {
            $table->id();
            $table->char('code',15);
            $table->unsignedBigInteger('company_id')->comment('ID บริษัทที่ยื่นแผนธุรกิจ');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('business_plan_status_id')->default(1);
            $table->unsignedBigInteger('business_plan_active_status_id')->default(1);
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
        Schema::dropIfExists('business_plans');
    }
}
