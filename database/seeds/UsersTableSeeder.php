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
                'user_type_id' => 4,
                'name' => 'master',
                'email' => 'joerocknpc@gmail.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 4,
                'name' => 'coleader',
                'email' => 'programprc@gmail.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 5,
                'name' => 'leader',
                'email' => 'ttrsassessment@gmail.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ]
        ]);
    }
}

