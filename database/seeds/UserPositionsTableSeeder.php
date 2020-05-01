<?php

use Illuminate\Database\Seeder;

class UserPositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_positions')->insert([
            [
                'name' => 'ผู้จัดการ'
            ],
            [
                'name' => 'กรรมการ'
            ]
        ]);
    }
}
