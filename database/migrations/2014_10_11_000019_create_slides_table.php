<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->char('usestyle')->default(1)->comment('1=ใช้ 2=ไม่ใช้'); 
            $table->char('style')->default(1)->comment('1=style1 2=style2');
            $table->string('style1_text1');
            $table->string('style1_text2');
            $table->string('style1_text3');
            $table->string('style1_slide');
            $table->string('style1_link');
            $table->string('style2_text1');
            $table->string('style2_text2');
            $table->string('style2_text3');
            $table->string('style2_slide');
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
        Schema::dropIfExists('slides');
    }
}
