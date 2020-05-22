<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_education', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ID ผู้เชี่ยวชาญ');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('education_level_id');
            $table->unsignedBigInteger('education_branch_id');
            $table->string('institute',150);
            $table->unsignedBigInteger('country_id');
            $table->char('graduatedyear',4);
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
        Schema::dropIfExists('expert_education');
    }
}
