<?php

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
                'receiver_id' => 1
            ],
            [
                'message_box_id' => 2,
                'receiver_id' => 1
            ],
            [
                'message_box_id' => 3,
                'receiver_id' => 1
            ]
        ]);
    }
}