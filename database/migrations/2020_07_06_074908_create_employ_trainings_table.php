<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employ_trainings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_employ_id');
            $table->foreign('company_employ_id')->references('id')->on('company_employs')->onDelete('cascade');
            $table->date('trainingdate')->nullable();
            $table->string('course',120)->nullable();
            $table->string('owner',120)->nullable();
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
        Schema::dropIfExists('employ_trainings');
    }
}
