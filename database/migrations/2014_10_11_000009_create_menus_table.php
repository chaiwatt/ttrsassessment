<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->string('name',250)->comment('ชื่อเมนูเว็บไซต์ ภาษาไทย');
            $table->string('slug');
            $table->string('engname',250)->comment('ชื่อเมนูเว็บไซต์ ภาษาอังกฤษ');
            $table->string('engslug',250);
            $table->unsignedBigInteger('page_id')->nullable();
            $table->char('hide')->default(1)->comment('ซ่อน/แสดงเมนู');
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
        Schema::dropIfExists('menus');
    }
}
