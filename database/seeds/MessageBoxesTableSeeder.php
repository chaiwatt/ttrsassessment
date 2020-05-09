<?php

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
                'title' => 'หัวข้อ1',
                'body' => 'บทความ1',
                'message_priority_id' => 1,
                'sender_id' => 9,
                'message_read_status_id' => 1,
            ],
            [
                'title' => 'หัวข้อ2',
                'body' => 'บทความ2',
                'message_priority_id' => 1,
                'sender_id' => 10,
                'message_read_status_id' => 1,
            ],
            [
                'title' => 'หัวข้อ3',
                'body' => 'บทความ3',
                'message_priority_id' => 1,
                'sender_id' => 11,
                'message_read_status_id' => 1,
            ]
        ]);
    }
}
