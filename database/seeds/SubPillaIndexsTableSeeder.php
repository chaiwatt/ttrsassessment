<?php

use Illuminate\Database\Seeder;

class SubPillaIndexsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_pilla_indices')->insert([
            [
                'sub_pilla_id' => 1,
                'name' => 'ประสบการณ์ชีวิต'
            ],
            [
                'sub_pilla_id' => 1,
                'name' => 'ระดับชั้น'
            ],
            [
                'sub_pilla_id' => 1,
                'name' => 'ความเข้าใจ'
            ],
            [
                'sub_pilla_id' => 1,
                'name' => 'ความคิด'
            ],
            [
                'sub_pilla_id' => 2,
                'name' => 'บริหารบุคคล'
            ],
            [
                'sub_pilla_id' => 2,
                'name' => 'ลักษณะบุคคล'
            ],
            [
                'sub_pilla_id' => 2,
                'name' => 'ทักษะ'
            ],
            [
                'sub_pilla_id' => 2,
                'name' => 'กลยุทธ์'
            ],
            [
                'sub_pilla_id' => 3,
                'name' => 'ความรู้'
            ],
            [
                'sub_pilla_id' => 3,
                'name' => 'ส่วนร่วม'
            ],
            [
                'sub_pilla_id' => 3,
                'name' => 'ความสัมพันธ์'
            ],
            [
                'sub_pilla_id' => 3,
                'name' => 'สร้างสรรค์'
            ],
            [
                'sub_pilla_id' => 4,
                'name' => 'โครงสร้าง'
            ],
            [
                'sub_pilla_id' => 4,
                'name' => 'คุณภาพ'
            ],
            [
                'sub_pilla_id' => 4,
                'name' => 'ความสามารถ'
            ],
            [
                'sub_pilla_id' => 4,
                'name' => 'โครงสร้างพื้นฐาน'
            ],
            [
                'sub_pilla_id' => 5,
                'name' => 'Award'
            ],
            [
                'sub_pilla_id' => 5,
                'name' => 'ทรัพย์สิน'
            ],
            [
                'sub_pilla_id' => 5,
                'name' => 'ค่าใช้จ่าย'
            ],
            [
                'sub_pilla_id' => 6,
                'name' => 'ความต่าง'
            ],
            [
                'sub_pilla_id' => 6,
                'name' => 'คัดลอก'
            ],
            [
                'sub_pilla_id' => 6,
                'name' => 'ตำแหน่ง'
            ],
            [
                'sub_pilla_id' => 6,
                'name' => 'แปรรูป'
            ],
            [
                'sub_pilla_id' => 7,
                'name' => 'สถานภาพ'
            ],
            [
                'sub_pilla_id' => 7,
                'name' => 'เลิศ'
            ],
            [
                'sub_pilla_id' => 7,
                'name' => 'ขยาย'
            ],
            [
                'sub_pilla_id' => 8,
                'name' => 'ขนาด'
            ],
            [
                'sub_pilla_id' => 8,
                'name' => 'การเติบโต'
            ],
            [
                'sub_pilla_id' => 9,
                'name' => 'สถานะ'
            ],
            [
                'sub_pilla_id' => 9,
                'name' => 'อุปสรรค'
            ],
            [
                'sub_pilla_id' => 9,
                'name' => 'เงื่อนไข'
            ],
            [
                'sub_pilla_id' => 10,
                'name' => 'จดจำ'
            ],
            [
                'sub_pilla_id' => 10,
                'name' => 'ส่วนแบ่ง'
            ],
            [
                'sub_pilla_id' => 10,
                'name' => 'ข้อได้เปรียบ'
            ],
            [
                'sub_pilla_id' => 11,
                'name' => 'คุณภาพ'
            ],
            [
                'sub_pilla_id' => 11,
                'name' => 'เพียงพอ'
            ],
            [
                'sub_pilla_id' => 11,
                'name' => 'เข้าถึง'
            ],
            [
                'sub_pilla_id' => 12,
                'name' => 'โมเดล'
            ],
            [
                'sub_pilla_id' => 12,
                'name' => 'รายได้'
            ],
            [
                'sub_pilla_id' => 12,
                'name' => 'กำไรสุทธิ'
            ]
        ]);
    }
}
