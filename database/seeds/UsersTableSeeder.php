<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'prefix_id' => 1,
                'user_type_id' => 1,
                'name' => 'admin',
                'email' => 'joerocknpc@gmail.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 2,
                'name' => 'expert',
                'email' => 'expert@npctestserver.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 3,
                'name' => 'user1',
                'email' => 'user1@npctestserver.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 3,
                'name' => 'user2',
                'email' => 'user2@npctestserver.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 3,
                'name' => 'user3',
                'email' => 'user3@npctestserver.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 3,
                'name' => 'user4',
                'email' => 'user4@npctestserver.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 3,
                'name' => 'user5',
                'email' => 'user5@npctestserver.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 3,
                'name' => 'user6',
                'email' => 'user6@npctestserver.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 3,
                'name' => 'user7',
                'email' => 'user7@npctestserver.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 3,
                'name' => 'user8',
                'email' => 'user8@npctestserver.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 3,
                'name' => 'user9',
                'email' => 'user9@npctestserver.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 3,
                'name' => 'user10',
                'email' => 'user10@npctestserver.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ]
        ]);
    }
}

