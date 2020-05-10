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
                'texteng1' => 'Submit an application',
                'text2' => 'ผู้ประกอบการยื่นใบสมัครในระบบ TTRS',
                'texteng2' => 'The company submits an application in the TTRS system',
            ],
            [
                'text1' => 'กรอกแบบฟอร์ม',
                'texteng1' => 'Fill out the form',
                'text2' => 'กรอกแบบฟอร์มและส่งเอกสารเพิ่มเติมตามที่แจ้งในระบบ',
                'texteng2' => 'Fill out the form and submit additional documents as informed in the system.',
            ],
            [
                'text1' => 'พิจารณาเบื้องต้น',
                'texteng1' => 'Fill out the form',
                'text2' => 'ผู้เชี่ยวชาญพิจารณาเบื้องต้น',
                'texteng2' => 'Experts consider the preliminary',
            ],
            [
                'text1' => 'ตรวจประเมิน',
                'texteng1' => 'Fill out the form',
                'text2' => 'ตรวจประเมินการใช้เทคโนโลยีและการประกอบธุรกิจ',
                'texteng2' => 'Assess the use of technology and business operations',
            ],
            [
                'text1' => 'เข้าสู่ระบบการประเมิน',
                'texteng1' => 'Assessment process',
                'text2' => 'เข้าสู่ระบบการประเมินเทคโนโลยี',
                'texteng2' => 'Begin technology assessment',
            ],
            [
                'text1' => 'การจัดอันดับเทคโนโลยี',
                'texteng1' => 'Technology ranking',
                'text2' => 'การจัดอันดับเทคโนโลยีและออกใบรับรอง',
                'texteng2' => 'Technology ranking and certification',
            ]
        ]);
    }
}
