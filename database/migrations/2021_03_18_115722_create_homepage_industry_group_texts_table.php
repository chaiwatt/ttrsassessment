<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepageIndustryGroupTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage_industry_group_texts', function (Blueprint $table) {
            $table->id();
            $table->string('titleth',250);
            $table->string('titleeng',250);
            $table->string('subtitleth',250);
            $table->string('subtitleeng',250);
            $table->string('url',250);
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
        Schema::dropIfExists('homepage_industry_group_texts');
    }
}
