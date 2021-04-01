<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullTbpProjectCertifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_tbp_project_certifies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('full_tbp_id');
            $table->foreign('full_tbp_id')->references('id')->on('full_tbps')->onDelete('cascade');
            $table->char('cer1',1)->comment('ได้รับการจดสิทธิบัตรการประดิษฐ์')->nullable();
            $table->char('cer1_qty',3)->nullable();
            $table->char('cer2',1)->comment('ยื่นจดสิทธิบัตรการประดิษฐ์')->nullable();
            $table->char('cer2_qty',3)->nullable();
            $table->char('cer3',1)->comment('ได้รับการจดสิทธิบัตรการออกแบบ')->nullable();
            $table->char('cer3_qty',3)->nullable();
            $table->char('cer4',1)->comment('ยื่นจดสิทธิบัตรการออกแบบ')->nullable();
            $table->char('cer4_qty',3)->nullable();
            $table->char('cer5',1)->comment('ได้รับการจดอนุสิทธิบัตร')->nullable();
            $table->char('cer5_qty',3)->nullable();
            $table->char('cer6',1)->comment('ยื่นจดอนุสิทธิบัตร')->nullable();
            $table->char('cer6_qty',3)->nullable();
            $table->char('cer7',1)->comment('ลิขสิทธิ์')->nullable();
            $table->char('cer7_qty',3)->nullable();
            $table->char('cer8',1)->comment('เครื่องหมายการค้า')->nullable();
            $table->char('cer8_qty',3)->nullable();
            $table->char('cer9',1)->comment('ความลับทางการค้า')->nullable();
            $table->char('cer9_qty',3)->nullable();
            $table->char('cer10',1)->comment('ซื้อหรือต่อยอดทรัพย์สินทางปัญญา')->nullable();
            $table->char('cer11',1)->comment('อื่น ๆ เช่น สิ่งบ่งชี้ทางภูมิศาสตร์ (GI) ความหลากหลายทางพันธุ์พืช แบบผังภูมิของวงจรรวม')->nullable();
            $table->char('cer11_qty',3)->nullable();
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
        Schema::dropIfExists('full_tbp_project_certifies');
    }
}
