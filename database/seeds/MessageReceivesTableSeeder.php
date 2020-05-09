<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MessageReceivesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('message_receives')->insert([
            [
                'message_box_id' => 1,
                'receiver_id' => 1,
                'message_read_status_id' => 1,
                'created_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString(),
                'updated_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString()
            ],
            [
                'message_box_id' => 2,
                'receiver_id' => 1,
                'message_read_status_id' => 1,
                'created_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString(),
                'updated_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString()
            ],
            [
                'message_box_id' => 3,
                'receiver_id' => 1,
                'message_read_status_id' => 2,
                'created_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString(),
                'updated_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString()
            ]
        ]);
    }
}