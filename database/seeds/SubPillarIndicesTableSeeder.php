<?php

use Illuminate\Database\Seeder;

class SubPillarIndicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_pillar_indices')->insert([
            [
                'sub_pillar_id' => 1,
                'name' => 'ประสบการณ์ชีวิต'
            ],
            [
                'sub_pillar_id' => 1,
                'name' => 'ระดับชั้น'
            ],
            [
                'sub_pillar_id' => 1,
                'name' => 'ความเข้าใจ'
            ],
            [
                'sub_pillar_id' => 1,
                'name' => 'ความคิด'
            ],
            [
                'sub_pillar_id' => 2,
                'name' => 'บริหารบุคคล'
            ],
            [
                'sub_pillar_id' => 2,
                'name' => 'ลักษณะบุคคล'
            ],
            [
                'sub_pillar_id' => 2,
                'name' => 'ทักษะ'
            ],
            [
                'sub_pillar_id' => 2,
                'name' => 'กลยุทธ์'
            ],
            [
                'sub_pillar_id' => 3,
                'name' => 'ความรู้'
            ],
            [
                'sub_pillar_id' => 3,
                'name' => 'ส่วนร่วม'
            ],
            [
                'sub_pillar_id' => 3,
                'name' => 'ความสัมพันธ์'
            ],
            [
                'sub_pillar_id' => 3,
                'name' => 'สร้างสรรค์'
            ],
            [
                'sub_pillar_id' => 4,
                'name' => 'โครงสร้าง'
            ],
            [
                'sub_pillar_id' => 4,
                'name' => 'คุณภาพ'
            ],
            [
                'sub_pillar_id' => 4,
                'name' => 'ความสามารถ'
            ],
            [
                'sub_pillar_id' => 4,
                'name' => 'โครงสร้างพื้นฐาน'
            ],
            [
                'sub_pillar_id' => 5,
                'name' => 'Award'
            ],
            [
                'sub_pillar_id' => 5,
                'name' => 'ทรัพย์สิน'
            ],
            [
                'sub_pillar_id' => 5,
                'name' => 'ค่าใช้จ่าย'
            ],
            [
                'sub_pillar_id' => 6,
                'name' => 'ความต่าง'
            ],
            [
                'sub_pillar_id' => 6,
                'name' => 'คัดลอก'
            ],
            [
                'sub_pillar_id' => 6,
                'name' => 'ตำแหน่ง'
            ],
            [
                'sub_pillar_id' => 6,
                'name' => 'แปรรูป'
            ],
            [
                'sub_pillar_id' => 7,
                'name' => 'สถานภาพ'
            ],
            [
                'sub_pillar_id' => 7,
                'name' => 'เลิศ'
            ],
            [
                'sub_pillar_id' => 7,
                'name' => 'ขยาย'
            ],
            [
                'sub_pillar_id' => 8,
                'name' => 'ขนาด'
            ],
            [
                'sub_pillar_id' => 8,
                'name' => 'การเติบโต'
            ],
            [
                'sub_pillar_id' => 9,
                'name' => 'สถานะ'
            ],
            [
                'sub_pillar_id' => 9,
                'name' => 'อุปสรรค'
            ],
            [
                'sub_pillar_id' => 9,
                'name' => 'เงื่อนไข'
            ],
            [
                'sub_pillar_id' => 10,
                'name' => 'จดจำ'
            ],
            [
                'sub_pillar_id' => 10,
                'name' => 'ส่วนแบ่ง'
            ],
            [
                'sub_pillar_id' => 10,
                'name' => 'ข้อได้เปรียบ'
            ],
            [
                'sub_pillar_id' => 11,
                'name' => 'คุณภาพ'
            ],
            [
                'sub_pillar_id' => 11,
                'name' => 'เพียงพอ'
            ],
            [
                'sub_pillar_id' => 11,
                'name' => 'เข้าถึง'
            ],
            [
                'sub_pillar_id' => 12,
                'name' => 'โมเดล'
            ],
            [
                'sub_pillar_id' => 12,
                'name' => 'รายได้'
            ],
            [
                'sub_pillar_id' => 12,
                'name' => 'กำไรสุทธิ'
            ]
        ]);
    }
}
