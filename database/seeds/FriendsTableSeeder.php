<?php

use Illuminate\Database\Seeder;

class FriendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('friends')->insert([
            [
                'user_id' => 1,
                'friend_id' => 10
            ],
            [
                'user_id' => 1,
                'friend_id' => 11
            ],
            [
                'user_id' => 1,
                'friend_id' => 12
            ]
        ]);
    }
}
