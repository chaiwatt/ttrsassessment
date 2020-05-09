<?php

use Illuminate\Database\Seeder;

class FriendStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('friend_statuses')->insert([
            [
                'name' => 'ขอเป็นเพื่อนกับคุณ'
            ],
            [
                'name' => 'ส่งคำขอเป็นเพื่อนแล้ว'
            ],
            [
                'name' => 'เพื่อน'
            ]
        ]);
    }
}
