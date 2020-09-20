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
                'name' => 'สมชาย',
                'lastname' => 'สกุลผู้เชียวชาญ1',
                'email' => 'ttrsexpert1@gmail.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 3,
                'name' => 'สมหญิง',
                'lastname' => 'สกุลผู้เชียวชาญ2',
                'email' => 'ttrsexpert2@gmail.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 4,
                'name' => 'สมปอง',
                'lastname' => 'สกุลลิดเดอร์',
                'email' => 'programprc@gmail.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 4,
                'name' => 'สมหวัง',
                'lastname' => 'สกุลผู้ช่วยลิดเดอร์',
                'email' => 'edutechthai@gmail.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 5,
                'name' => 'สมคิด',
                'lastname' => 'สกุลแอดมิน',
                'email' => 'ttrsassessment@gmail.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 6,
                'name' => 'สมนึก',
                'lastname' => 'สกุลเจดี',
                'email' => 'joerocknpc@gmail.com',           
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ]
        ]);
    }
}

