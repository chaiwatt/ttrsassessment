<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_receives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_box_id');
            $table->foreign('message_box_id')->references('id')->on('message_boxes')->onDelete('cascade');
            $table->unsignedBigInteger('receiver_id')->comment('ID ผู้รับ');
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
        Schema::dropIfExists('message_receives');
    }
}
