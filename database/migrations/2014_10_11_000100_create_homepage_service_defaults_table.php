<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepageServiceDefaultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage_service_defaults', function (Blueprint $table) {
            $table->id();
            $table->string('titlethai',250)->nullable();
            $table->string('titleeng',250)->nullable();
            $table->string('descriptionthai',250)->nullable();
            $table->string('descriptioneng',250)->nullable();
            $table->string('icon',250)->nullable();
            $table->string('link',250)->nullable();
            $table->string('iconnormal',250)->nullable();
            $table->string('iconhover',250)->nullable();
            $table->char('colortype',1)->default(0);
            $table->string('color',100)->nullable();
            $table->unsignedBigInteger('cardcolor_id');
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
        Schema::dropIfExists('homepage_service_defaults');
    }
}
