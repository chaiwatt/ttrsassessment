<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullTbpProjectCertifyAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_tbp_project_certify_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_certify_id');
            $table->foreign('project_certify_id')->references('id')->on('full_tbp_project_certifies')->onDelete('cascade');
            $table->string('name',120);
            $table->string('path',250);
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
        Schema::dropIfExists('full_tbp_project_certify_attachments');
    }
}