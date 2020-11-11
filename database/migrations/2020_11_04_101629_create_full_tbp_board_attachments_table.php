<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullTbpBoardAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_tbp_board_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_employ_id');
            $table->foreign('company_employ_id')->references('id')->on('company_employs')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('path')->nullable();
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
        Schema::dropIfExists('full_tbp_board_attachments');
    }
}
