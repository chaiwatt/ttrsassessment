<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraFactorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_factors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_cluster_id');
            $table->foreign('sub_cluster_id')->references('id')->on('sub_clusters')->onDelete('cascade');
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
        Schema::dropIfExists('extra_factors');
    }
}
