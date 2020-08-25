<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evs', function (Blueprint $table) {
            $table->id();
            $table->string('name',250);
            $table->string('version',10);
            $table->unsignedBigInteger('ref_assessment_group_id')->nullable();
            $table->unsignedBigInteger('full_tbp_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('evs');
    }
}
