<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_criterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('extra_category_id');
            $table->foreign('extra_category_id')->references('id')->on('extra_categories')->onDelete('cascade');
            $table->string('name',150);
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
        Schema::dropIfExists('extra_criterias');
    }
}
