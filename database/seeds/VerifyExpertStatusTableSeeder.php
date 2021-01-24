<?php

use Illuminate\Database\Seeder;

class VerifyExpertStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('verify_expert_statuses')->insert([
            [
                'name' => 'ไม่ต้องยืนยัน'
            ],
            [
                'name' => 'ต้องยืนยัน'
            ]
        ]);
    }
}
