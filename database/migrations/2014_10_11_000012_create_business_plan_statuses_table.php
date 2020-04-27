<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPlanStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_plan_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name',250)->comment('ชื่อสถานะการยื่นแผนธุรกิจ/ประเมิน เช่น รอการยืนยันการรับการประเมิน รอผลการประเมิน ไม่ผ่านการประเมิน ผ่านการประเมิน');
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
        Schema::dropIfExists('business_plan_statuses');
    }
}
