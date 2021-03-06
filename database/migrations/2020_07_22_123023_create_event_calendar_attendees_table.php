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
            $table->unsignedBigInteger('user_id');
            $table->char('joinevent',1)->default('1');
            $table->char('color',10)->default('#FF33E6');
            $table->text('rejectreason')->nullable();
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
