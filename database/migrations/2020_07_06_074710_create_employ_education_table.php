<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employ_education', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_employ_id');
            $table->foreign('company_employ_id')->references('id')->on('company_employs')->onDelete('cascade');
            $table->string('employeducationlevel',120)->nullable();
            $table->string('otheremployeducationlevel',120)->nullable();
            $table->string('employeducationinstitute',120)->nullable();
            $table->string('employeducationmajor',120)->nullable();
            $table->string('employeducationyear',120)->nullable();
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
        Schema::dropIfExists('employ_education');
    }
}
