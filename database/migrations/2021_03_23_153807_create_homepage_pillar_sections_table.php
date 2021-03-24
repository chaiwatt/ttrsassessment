<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepagePillarSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage_pillar_sections', function (Blueprint $table) {
            $table->id();
            $table->string('textth1',250)->nullable();
            $table->string('texteng1',250)->nullable();
            $table->string('textth2',250)->nullable();
            $table->string('texteng2',250)->nullable();
            $table->string('pillartitleth1',250)->nullable();
            $table->string('pillartitleeng1',250)->nullable();
            $table->string('pillartitleth2',250)->nullable();
            $table->string('pillartitleeng2',250)->nullable();
            $table->string('pillartitleth3',250)->nullable();
            $table->string('pillartitleeng3',250)->nullable();
            $table->string('pillartitleth4',250)->nullable();
            $table->string('pillartitleeng4',250)->nullable();
            $table->string('pillardescth1',250)->nullable();
            $table->string('pillardesceng1',250)->nullable();
            $table->string('pillardescth2',250)->nullable();
            $table->string('pillardesceng2',250)->nullable();
            $table->string('pillardescth3',250)->nullable();
            $table->string('pillardesceng3',250)->nullable();
            $table->string('pillardescth4',250)->nullable();
            $table->string('pillardesceng4',250)->nullable();
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
        Schema::dropIfExists('homepage_pillar_sections');
    }
}
