<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectMenu2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_menu2s', function (Blueprint $table) {
            $table->id();
            $table->string('name',250)->comment('ชื่อเมนูเว็บไซต์ ภาษาไทย');
            $table->string('slug')->nullable();
            $table->string('engname',250)->comment('ชื่อเมนูเว็บไซต์ ภาษาอังกฤษ');
            $table->string('engslug',250)->nullable();
            $table->string('url',250)->nullable();
            $table->char('hide')->default(1)->comment('ซ่อน/แสดงเมนู');
            $table->char('view',10)->default(0);
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
        Schema::dropIfExists('direct_menu2s');
    }
}
