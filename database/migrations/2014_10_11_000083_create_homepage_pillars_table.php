<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepagePillarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage_pillars', function (Blueprint $table) {
            $table->id();
            $table->text('headerthai',250)->nullable();
            $table->text('headereng',250)->nullable();
            $table->longText('descriptionthai',250)->nullable();
            $table->longText('descriptioneng',250)->nullable();
            $table->text('pillarimage1',250)->nullable();
            $table->text('pillarimage2',250)->nullable();
            $table->text('pillarimage3',250)->nullable();
            $table->text('pillarimage4',250)->nullable();

            $table->text('pillarheader1',250)->nullable();
            $table->text('pillarheader2',250)->nullable();
            $table->text('pillarheader3',250)->nullable();
            $table->text('pillarheader4',250)->nullable();

            $table->text('pillardescriptionthai1',250)->nullable();
            $table->text('pillardescriptioneng1',250)->nullable();
            $table->text('pillardescriptionthai2',250)->nullable();
            $table->text('pillardescriptioneng2',250)->nullable();
            $table->text('pillardescriptionthai3',250)->nullable();
            $table->text('pillardescriptioneng3',250)->nullable();
            $table->text('pillardescriptionthai4',250)->nullable();
            $table->text('pillardescriptioneng4',250)->nullable();

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
        Schema::dropIfExists('homepage_pillars');
    }
}
