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
                'name' => 'ผู้ขอรับการประเมินนิติบุคคล',   
                'group' => 'A'
            ],
            [
                'name' => 'ผู้ขอรับการประเมินบุคคลธรรมดา',
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
                'name' => 'Admin',
                'group' => 'B'
            ],
            [
                'name' => 'Manager',
                'group' => 'C'
            ]
        ]);
    }
}
