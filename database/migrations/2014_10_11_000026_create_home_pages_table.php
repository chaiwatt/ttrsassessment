<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();
            $table->char('slidesection',1)->default(1);
            $table->char('introsection1',1)->default(1);
            $table->char('introsection2',1)->default(1);
            $table->char('introsection3',1)->default(1);
            $table->char('pagesection',1)->default(1);
            $table->char('bodysection1',1)->default(1);
            $table->char('bodysection2',1)->default(1);
            $table->char('bodysection3',1)->default(1);
            $table->char('bottomsection',1)->default(1);
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
        Schema::dropIfExists('home_pages');
    }
}
