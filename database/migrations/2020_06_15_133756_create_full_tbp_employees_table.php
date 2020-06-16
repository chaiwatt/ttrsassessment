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
            $table->char('department1_qty',2)->default(0)->comment('ฝ่ายบริหาร');
            $table->char('department2_qty',2)->default(0)->comment('ฝ่ายวิจัยและพัฒนา');
            $table->char('department3_qty',2)->default(0)->comment('ฝ่ายผลิต/วิศวกรรม');
            $table->char('department4_qty',2)->default(0)->comment('ฝ่ายการตลาด');
            $table->char('department5_qty',2)->default(0)->comment('พนักงานทั่วไป');
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
