<?php

use Illuminate\Database\Seeder;

class LoginVerificationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('login_verification_types')->insert([
            [
                'name' => 'ไม่ตรวจสอบ'
            ],
            [
                'name' => 'Line verification'
            ],
            [
                'name' => 'Email verification'
            ],
            [
                'name' => 'SMS verification'
            ]
        ]);
    }
}
