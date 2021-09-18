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
            $table->string('textth1')->nullable();
            $table->string('texteng1')->nullable();
            $table->longText('textth2')->nullable();
            $table->longText('texteng2')->nullable();
            $table->string('titleth')->nullable();
            $table->string('titleen')->nullable();
            $table->longText('detailth')->nullable();
            $table->longText('detailen')->nullable();
            $table->string('pillartitleth1',250)->nullable();
            $table->string('pillartitleeng1',250)->nullable();
            $table->string('color1',250)->default('background-image: linear-gradient(180deg, #dd4c23 0%, #f27c1e 100%);');
            $table->string('pillartitleth2',250)->nullable();
            $table->string('pillartitleeng2',250)->nullable();
            $table->string('color2',250)->default('background-image: linear-gradient(90deg, #a040f3 41%, #a86ae3 100%);');
            $table->string('pillartitleth3',250)->nullable();
            $table->string('pillartitleeng3',250)->nullable();
            $table->string('color3',250)->default('background-image: linear-gradient(90deg, #559cea 41%, #6ba3cb 100%);');
            $table->string('pillartitleth4',250)->nullable();
            $table->string('pillartitleeng4',250)->nullable();
            $table->string('color4',250)->default('background-image: linear-gradient(90deg, #f954a1 41%, #f2a1c6 100%);');
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
