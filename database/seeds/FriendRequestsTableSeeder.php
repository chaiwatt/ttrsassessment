<?php

use Illuminate\Database\Seeder;

class FriendRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('friend_requests')->insert([
            [
                'from_id' => 1,
                'to_id' => 4,
                'friend_status_id' => 2
            ],
            [
                'from_id' => 1,
                'to_id' => 5,
                'friend_status_id' => 2
            ],
            [
                'from_id' => 6,
                'to_id' => 1,
                'friend_status_id' => 2
            ],
            [
                'from_id' => 7,
                'to_id' => 1,
                'friend_status_id' => 2
            ],
            [
                'from_id' => 8,
                'to_id' => 1,
                'friend_status_id' => 2
            ],
        ]);
    }
}
