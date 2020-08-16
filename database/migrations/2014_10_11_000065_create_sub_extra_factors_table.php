<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubExtraFactorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_extra_factors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('extra_factor_id');
            $table->foreign('extra_factor_id')->references('id')->on('extra_factors')->onDelete('cascade');
            $table->string('name',250);
            $table->float('value')->default(0);
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
        Schema::dropIfExists('sub_extra_factors');
    }
}
