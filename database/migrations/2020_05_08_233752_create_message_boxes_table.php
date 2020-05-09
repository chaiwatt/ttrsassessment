<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_boxes', function (Blueprint $table) {
            $table->id();
            $table->string('title',150);
            $table->text('body');
            $table->unsignedBigInteger('message_priority_id')->comment('ระดับความสำคัญ');
            $table->unsignedBigInteger('sender_id')->comment('ID ผู้ส่ง');
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
        Schema::dropIfExists('message_boxes');
    }
}
