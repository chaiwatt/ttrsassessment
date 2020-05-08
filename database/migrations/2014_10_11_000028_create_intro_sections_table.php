<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntroSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intro_sections', function (Blueprint $table) {
            $table->id();
            $table->string('text1',250)->comment('title intro');
            $table->string('text2',250)->comment('ข้อความ intro');
            $table->string('icon',250)->comment('รูปไอคอน')->nullable();
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
        Schema::dropIfExists('intro_sections');
    }
}
