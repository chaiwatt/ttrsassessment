<?php

use Illuminate\Database\Seeder;

class SocialLoginStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('social_login_statuses')->insert([
            [
                'name' => 'ปิด'
            ],
            [
                'name' => 'เปิด'
            ]
        ]);
    }
}
