<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventCalendarAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_calendar_attendees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_calendar_id');
            $table->foreign('event_calendar_id')->references('id')->on('event_calendars')->onDelete('cascade');
            $table->string('email',100);
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
        Schema::dropIfExists('event_calendar_attendees');
    }
}
