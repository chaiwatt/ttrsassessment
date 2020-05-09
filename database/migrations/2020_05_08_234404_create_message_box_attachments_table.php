<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageBoxAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_box_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_box_id');
            $table->foreign('message_box_id')->references('id')->on('message_boxes')->onDelete('cascade');
            $table->string('name',150)->nullable();
            $table->string('attachment',250)->nullable();
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
        Schema::dropIfExists('message_box_attachments');
    }
}
