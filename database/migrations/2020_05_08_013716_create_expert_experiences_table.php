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
            $table->unsignedBigInteger('user_id')->comment('ID ผู้เชี่ยวชาญ');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('position',250)->nullable();
            $table->string('jobdetail')->nullable();
            $table->string('company',250)->nullable();
            $table->char('fromyear',4)->nullable();
            $table->char('toyear',4)->nullable();
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
