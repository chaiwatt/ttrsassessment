<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsicSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isic_subs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('isic_id');
            $table->foreign('isic_id')->references('id')->on('isics')->onDelete('cascade');
            $table->string('name',250);
            $table->char('code',10);
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
        Schema::dropIfExists('isic_subs');
    }
}
