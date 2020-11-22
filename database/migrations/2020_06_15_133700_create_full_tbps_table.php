<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullTbpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_tbps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mini_tbp_id');
            $table->foreign('mini_tbp_id')->references('id')->on('mini_t_b_p_s')->onDelete('cascade');
            $table->string('fulltbp_code',20)->nullable();
            $table->unsignedBigInteger('signature_status_id')->default(1);
            // $table->string('file',250)->nullable();
            $table->char('status',1)->default(1);
            $table->char('asic',1)->nullable();
            $table->unsignedBigInteger('criteria_group_id')->nullable();
            $table->char('assignexpert',1)->default(1);
            $table->char('refixstatus',1)->default(0);
            $table->longText('abtract')->nullable();
            $table->longText('mainproduct')->nullable();
            $table->longText('productdetail')->nullable();
            $table->longText('techdev')->nullable();
            $table->longText('techdevproblem')->nullable();
            $table->longText('innovation')->nullable();
            $table->longText('standard')->nullable();
            $table->string('attachment',250)->nullable();
            $table->char('done_assessment',1)->default(0);
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
        Schema::dropIfExists('full_tbps');
    }
}
