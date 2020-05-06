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
            $table->unsignedBigInteger('slide_status_id')->comment('1=ใช้ 2=ไม่ใช้');
            $table->unsignedBigInteger('slide_style_id')->comment('1=style1 2=style2');
            $table->string('textone',250)->nullable();
            $table->string('texttwo',250)->nullable();
            $table->string('textthree',250)->nullable();
            $table->string('url',250)->nullable();
            $table->string('name',250);
            $table->string('file',250);
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
