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
                'name' => 'ผู้ใช้งานทั่วไป',   
                'group' => 'A'
            ],
            [
                'name' => 'ผู้ใช้งานนิติบุคคล',
                'group' => 'A'
            ],
            [
                'name' => 'ผู้เชี่ยวชาญ',
                'group' => 'B'
            ],
            [
                'name' => 'เจ้าหน้าที่ TTRS',
                'group' => 'B'
            ],
            [
                'name' => 'admin1',
                'group' => 'B'
            ],
            [
                'name' => 'admin2',
                'group' => 'B'
            ],
            [
                'name' => 'admin3',
                'group' => 'B'
            ],
            [
                'name' => 'admin4',
                'group' => 'B'
            ],
            [
                'name' => 'master',
                'group' => 'C'
            ],
            [
                'name' => 'director',
                'group' => 'C'
            ]
        ]);
    }
}
