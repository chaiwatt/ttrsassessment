<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepageServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage_services', function (Blueprint $table) {
            $table->id();
            $table->text('titlethai',250)->nullable();
            $table->text('titleeng',250)->nullable();
            $table->text('descriptionthai',250)->nullable();
            $table->text('descriptioneng',250)->nullable();
            $table->text('icon',250)->nullable();
            $table->text('link',250)->nullable();
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
        Schema::dropIfExists('homepage_services');
    }
}
