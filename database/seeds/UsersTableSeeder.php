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
                'email' => 'admin@npctestserver.com',           
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
                'name' => 'company',
                'email' => 'company@npctestserver.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
        ]);
    }
}

