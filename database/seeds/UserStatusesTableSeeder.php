<?php

use Illuminate\Database\Seeder;

class UserStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_statuses')->insert([
            [
                'name' => 'บัญชีปกติ'
            ],
            [
                'name' => 'ระงับการใช้งานบัญชี'
            ]
        ]);
    }
}
