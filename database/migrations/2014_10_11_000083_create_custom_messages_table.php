<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_messages', function (Blueprint $table) {
            $table->id();
            $table->string('nonecheckaccept_header',250)->default('ผิดพลาด!');
            $table->string('nonecheckaccept',250)->default('โปรดทำเครื่องหมาย <i class="icon-checkbox-checked"></i> เพื่อรับรองข้อมูลก่อนดำเนินการ');
            $table->string('noneselectdirector_header',250)->default('ผิดพลาด!');
            $table->string('noneselectdirector',250)->default('ยังไม่ได้เลือกผู้ลงนามในแบบฟอร์มแผนธุรกิจเทคโนโลยี');
            $table->string('noneselectsignature_header',250)->default('ผิดพลาด!');
            $table->string('noneselectsignature',250)->default('กรุณาเลือกการใช้ลายมือชื่ออิเล็กทรอนิกส์');
            $table->string('confirmsendfulltbp_header',250)->default('โปรดยืนยัน');
            $table->string('confirmsendfulltbp',250)->default('ยืนยันส่งแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)');
            $table->string('confirmuploadfulltbp_header',250)->default('อัปโหลดไฟล์');
            $table->string('confirmuploadfulltbp',250)->default('โปรดแนบไฟล์แบบฟอร์ม Full TBP ที่ลงลายมือชื่อและประทับตราแล้ว');
            $table->string('confirmsubmitfulltbp_header',250)->default('ยืนยัน');
            $table->string('confirmsubmitfulltbp',250)->default('ยืนยันส่งแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)');
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
        Schema::dropIfExists('custom_messages');
    }
}
