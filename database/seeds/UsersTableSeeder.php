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
                'user_type_id' => 3,
                'name' => 'expert1',
                'email' => 'ttrsexpert1@gmail.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 3,
                'name' => 'expert2',
                'email' => 'ttrsexpert2@gmail.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 4,
                'name' => 'leader1',
                'email' => 'programprc@gmail.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 4,
                'name' => 'coleader1',
                'email' => 'edutechthai@gmail.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 7,
                'name' => 'สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ',
                'email' => 'joerocknpc@gmail.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ]
        ]);
    }
}

