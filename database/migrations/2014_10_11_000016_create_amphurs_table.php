<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmphursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amphurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('amphur_id')->index();
            $table->unsignedBigInteger('province_id')->index();
            $table->string('name',100);
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
        Schema::dropIfExists('amphurs');
    }
}
