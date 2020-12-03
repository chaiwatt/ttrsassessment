<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullTbpResponsiblePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_tbp_responsible_people', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('full_tbp_id');
            $table->foreign('full_tbp_id')->references('id')->on('full_tbps')->onDelete('cascade');
            $table->unsignedBigInteger('prefix_id')->default(1);
            $table->string('name')->nullable();
            $table->string('lastname',250)->nullable();
            $table->string('email',250)->nullable();
            $table->string('position',250)->nullable();
            $table->string('phone1',250)->nullable();
            $table->string('phone2',250)->nullable();
            $table->longText('educationhistory')->nullable();
            $table->longText('experiencehistory')->nullable();
            $table->longText('traininghistory')->nullable();
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
        Schema::dropIfExists('full_tbp_responsible_people');
    }
}
