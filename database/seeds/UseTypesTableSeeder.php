<?php

use Illuminate\Database\Seeder;

class UseTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            [
                'name' => 'ผู้ใช้งาน'
            ],
            [
                'name' => 'ผู้เชี่ยวชาญ'
            ],
            [
                'name' => 'admin'
            ]
        ]);
    }
}
