<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('full_tbp_id');
            $table->foreign('full_tbp_id')->references('id')->on('full_tbps')->onDelete('cascade');
            $table->string('headercode',150)->default('ที่ อว ๖๐๐๑/');
            $table->string('contactname',150)->nullable();
            $table->string('contactlastname',150)->nullable();
            $table->string('contactposition',150)->nullable();
            $table->string('contactphone',150)->nullable();
            $table->string('contactphoneext',150)->default('111');
            $table->string('contactemail',150)->nullable();
            $table->string('contactfax',150)->nullable();
            $table->longText('management')->nullable();
            $table->longText('technoandinnovation')->nullable();
            $table->longText('marketability')->nullable();
            $table->longText('businessprospect')->nullable();
            $table->unsignedBigInteger('evaluation_day_id')->nullable();
            $table->unsignedBigInteger('evaluation_month_id')->nullable();
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
        Schema::dropIfExists('evaluation_results');
    }
}
