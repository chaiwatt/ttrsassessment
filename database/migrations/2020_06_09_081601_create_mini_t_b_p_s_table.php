<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiniTBPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mini_t_b_p_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_plan_id');
            $table->foreign('business_plan_id')->references('id')->on('business_plans')->onDelete('cascade');
            $table->char('ref_doc',15)->nullable();
            $table->string('minitbp_code',20)->nullable();
            $table->string('project',150)->nullable();
            $table->string('projecteng',150)->nullable();
            $table->char('finance1',5)->nullable()->comment('ขอสินเชื่อ)');
            $table->unsignedBigInteger('thai_bank_id')->nullable();
            $table->double('finance1_loan',10,2)->nullable();
            $table->char('finance2',5)->nullable()->comment('ขอรับการค้ำประกันสินเชื่อฯ บสย. (บรรษัทประกันสินเชื่ออุตสาหกรรมขนาดย่อม)');
            $table->char('finance3',5)->nullable()->comment('โครงการเงินกู้ดอกเบี้ยต่ำ (สวทช.)');
            $table->char('finance4',5)->nullable()->comment('บริษัทร่วมทุน (สวทช.)');
            $table->double('finance4_joint',10,2)->nullable();
            $table->double('finance4_joint_min',10,2)->nullable();
            $table->double('finance4_joint_max',10,2)->nullable();
            $table->char('nonefinance1',5)->nullable()->comment('โครงการขึ้นทะเบียนบัญชีนวัตกรรมไทย');
            $table->char('nonefinance2',5)->nullable()->comment('รับรองขอรับสิทธิประโยชน์ทางภาษี');
            $table->char('nonefinance3',5)->nullable()->comment('โครงการ spin off');
            $table->char('nonefinance4',5)->nullable()->comment('ที่ปรึกษาทางด้านเทคนิค/ด้านธุรกิจ');
            $table->string('nonefinance5',250)->nullable()->comment('โครงการสนับสนุนผู้ประกอบการภาครัฐ โปรดระบุ');
            $table->string('nonefinance5_detail',250)->nullable()->comment('โครงการสนับสนุนผู้ประกอบการภาครัฐ โปรดระบุ');
            $table->string('nonefinance6',250)->nullable()->comment('อื่น ๆ โปรดระบุ');
            $table->string('nonefinance6_detail',250)->nullable()->comment('อื่น ๆ โปรดระบุ');
            $table->unsignedBigInteger('contactprefix')->nullable();
            $table->string('contactname',250)->nullable();
            $table->string('contactlastname',250)->nullable();
            $table->char('contactphone',12)->nullable();
            $table->string('contactemail',250)->nullable();
            $table->string('contactposition')->nullable();
            $table->unsignedBigInteger('managerprefix_id')->nullable();
            $table->string('managername',250)->nullable();
            $table->string('managerlastname',250)->nullable();
            $table->unsignedBigInteger('managerposition_id')->nullable();
            $table->string('website',250)->nullable();
            $table->string('attachment',250)->nullable();
            $table->unsignedBigInteger('signature_status_id')->default(1);
            $table->char('submit',1)->default('1');
            $table->text('jdmessage')->nullable();
            $table->char('refixstatus',1)->default('0');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mini_t_b_p_s');
    }
}
