<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MessageBoxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('message_boxes')->insert([
            [
                'title' => 'สอบถามข้อมูลครับ',
                'body' => 'สอบถามข้อมูลครับ....',
                'message_priority_id' => 1,
                'sender_id' => 9,
                'created_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString(),
                'updated_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString()

            ],
            [
                'title' => 'สอบถามข้อมูลค่ะ',
                'body' => 'สอบถามข้อมูลค่ะ....',
                'message_priority_id' => 1,
                'sender_id' => 10,
                'created_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString(),
                'updated_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString()
            ],
            [
                'title' => 'สอบถามสถานะ',
                'body' => 'สอบถามสถานะ....',
                'message_priority_id' => 1,
                'sender_id' => 11,
                'created_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString(),
                'updated_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString()
            ]
        ]);
    }
}
