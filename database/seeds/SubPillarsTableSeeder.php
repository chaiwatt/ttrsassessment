<?php

use Illuminate\Database\Seeder;

class SubPillarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_pillars')->insert([
            [
                'pillar_id' => 1,
                'name' => 'พื้นฐานความรู้'
            ],
            [
                'pillar_id' => 1,
                'name' => 'ความสามารถ'
            ],
            [
                'pillar_id' => 1,
                'name' => 'คณะทำงาน'
            ],
            [
                'pillar_id' => 2,
                'name' => 'วิจัย'
            ],
            [
                'pillar_id' => 2,
                'name' => 'สถานะ'
            ],
            [
                'pillar_id' => 2,
                'name' => 'ระดับ'
            ],
            [
                'pillar_id' => 2,
                'name' => 'ความสมบูรณ์'
            ],
            [
                'pillar_id' => 3,
                'name' => 'ตลาด'
            ],
            [
                'pillar_id' => 3,
                'name' => 'ปัจจัย'
            ],
            [
                'pillar_id' => 3,
                'name' => 'แข่งขัน'
            ],
            [
                'pillar_id' => 4,
                'name' => 'ความสามารถ'
            ],
            [
                'pillar_id' => 4,
                'name' => 'กำไร'
            ]    
        ]);
    }
}
