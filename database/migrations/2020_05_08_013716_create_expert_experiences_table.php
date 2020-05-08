<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expert_id')->comment('ID ผู้เชี่ยวชาญ');
            $table->foreign('expert_id')->references('id')->on('experts')->onDelete('cascade');
            $table->string('position',250)->nullable();
            $table->string('jobdetail')->nullable();
            $table->string('company',250)->nullable();
            $table->date('fromyear')->nullable();
            $table->date('toyear')->nullable();
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
        Schema::dropIfExists('expert_experiences');
    }
}
