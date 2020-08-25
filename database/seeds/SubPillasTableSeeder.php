<?php

use Illuminate\Database\Seeder;

class SubPillasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_pillas')->insert([
            [
                'pilla_id' => 1,
                'name' => 'พื้นฐานความรู้'
            ],
            [
                'pilla_id' => 1,
                'name' => 'ความสามารถ'
            ],
            [
                'pilla_id' => 1,
                'name' => 'คณะทำงาน'
            ],
            [
                'pilla_id' => 2,
                'name' => 'วิจัย'
            ],
            [
                'pilla_id' => 2,
                'name' => 'สถานะ'
            ],
            [
                'pilla_id' => 2,
                'name' => 'ระดับ'
            ],
            [
                'pilla_id' => 2,
                'name' => 'ความสมบูรณ์'
            ],
            [
                'pilla_id' => 3,
                'name' => 'ตลาด'
            ],
            [
                'pilla_id' => 3,
                'name' => 'ปัจจัย'
            ],
            [
                'pilla_id' => 3,
                'name' => 'แข่งขัน'
            ],
            [
                'pilla_id' => 4,
                'name' => 'ความสามารถ'
            ],
            [
                'pilla_id' => 4,
                'name' => 'กำไร'
            ]
        ]);
    }
}
