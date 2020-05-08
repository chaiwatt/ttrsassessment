<?php

use Illuminate\Database\Seeder;

class IntroSectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('intro_sections')->insert([
            [
                'text1' => 'ยื่นใบสมัคร',
                'text2' => 'ผู้ประกอบการยื่นใบสมัครในระบบ TTRS',
            ],
            [
                'text1' => 'กรอกแบบฟอร์ม',
                'text2' => 'กรอกแบบฟอร์มและส่งเอกสารเพิ่มเติมตามที่แจ้งในระบบ',
            ],
            [
                'text1' => 'พิจารณา',
                'text2' => 'ผู้เชี่ยวชาญพิจารณาเบื้องต้น',
            ],
            [
                'text1' => 'ตรวจประเมิน',
                'text2' => 'ตรวจประเมินการใช้เทคโนโลยีและการประกอบธุรกิจ',
            ],
            [
                'text1' => 'เข้าสู่ระบบการประเมิน',
                'text2' => 'เข้าสู่ระบบการประเมินเทคโนโลยี',
            ],
            [
                'text1' => 'การจัดอันดับเทคโนโลยี',
                'text2' => 'การจัดอันดับเทคโนโลยีและออกใบรับรอง',
            ]
        ]);
    }
}
