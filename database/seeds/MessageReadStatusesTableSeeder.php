<?php

use Illuminate\Database\Seeder;

class MessageReadStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('message_read_statuses')->insert([
            [
                'name' => 'ยังไม่ได้อ่าน'
            ],
            [
                'name' => 'อ่านแล้ว'
            ]
        ]);
    }
}
