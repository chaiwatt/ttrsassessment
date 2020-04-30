<?php

use Illuminate\Database\Seeder;

class VerifyStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('verify_statuses')->insert([
            [
                'name' => 'ไม่ตรวจสอบ'
            ],
            [
                'name' => 'Line'
            ],
            [
                'name' => 'Email'
            ],
            [
                'name' => 'SMS'
            ]
        ]);
    }
}
