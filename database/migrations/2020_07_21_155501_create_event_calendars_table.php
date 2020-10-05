<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_calendars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('full_tbp_id');
            $table->foreign('full_tbp_id')->references('id')->on('full_tbps')->onDelete('cascade');
            $table->unsignedBigInteger('calendar_type_id')->default(1);
            $table->date('eventdate');
            $table->char('starttime',10);
            $table->char('endtime',10);
            $table->string('place',250);
            $table->string('room',50);
            $table->string('summary',250);
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
        Schema::dropIfExists('event_calendars');
    }
}
