<?php

use Illuminate\Database\Seeder;

class EventCalendarAttendeeStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_calendar_attendee_statuses')->insert([
            [
                'name' => 'เข้าร่วม'
            ],
            [
                'name' => 'ไม่เข้าร่วม'
            ]
        ]);
    }
}
