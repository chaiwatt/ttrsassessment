<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employ_experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_employ_id');
            $table->foreign('company_employ_id')->references('id')->on('company_employs')->onDelete('cascade');
            $table->string('company',120)->nullable();
            $table->string('businesstype',120)->nullable();
            $table->string('startposition',120)->nullable();
            $table->string('endposition',120)->nullable();
            $table->string('startdate')->nullable();
            $table->string('enddate')->nullable();
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
        Schema::dropIfExists('employ_experiences');
    }
}
