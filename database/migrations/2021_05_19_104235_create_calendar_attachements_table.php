<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarAttachementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_attachements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_calendar_id');
            $table->foreign('event_calendar_id')->references('id')->on('event_calendars')->onDelete('cascade');
            $table->string('name',250)->nullable();
            $table->string('path',250)->nullable();
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
        Schema::dropIfExists('calendar_attachements');
    }
}
