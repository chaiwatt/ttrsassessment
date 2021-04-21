<?php

use App\User;
use Carbon\Carbon;
use App\Helper\CreateCompany;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'prefix_id' => 1,
                'user_type_id' => 6,
                'name' => 'สมพร',
                'lastname' => 'สกุลเจดี',
                // 'email' => 'ttrsjd2020@gmail.com',     
                'email' => 'ttrsjd@npcsolution.com',     
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 5,
                'name' => 'สมนึก',
                'lastname' => 'สกุลแอดมิน',
                // 'email' => 'ttrsmanager2020@gmail.com', 
                'email' => 'ttrsadmin@npcsolution.com',          
                'password' => Hash::make('11111111'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
            [
                'prefix_id' => 1,
                'user_type_id' => 6,
                'name' => 'superadmin',
                'lastname' => 'superadmin',
                'email' => 'admin@npcsolution.com',           
                'password' => Hash::make('TtR$@Min2020'), 
                'email_verified_at' => Carbon::now()->toDateString(),
                'verify_type' => 1
            ],
        ]);
        DB::table('officer_details')->insert([
            [
                'user_id' => 1,
            ],
            [
                'user_id' => 2,
            ]
        ]);
        CreateCompany::createCompany(User::find(1),'สวทช','0994000165668',2);
        CreateCompany::createCompany(User::find(2),'สวทช','0994000165667',2);
    }
}
