<?php

use Illuminate\Database\Seeder;

class HomepageServiceDefaultsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('homepage_service_defaults')->insert([
            [
                'titlethai' => 'ยื่นใบสมัคร',
                'titleeng' => 'Registration process',
                'descriptionthai' => 'ผู้ประกอบการยื่นใบสมัครในระบบ TTRS',
                'descriptioneng' => 'Thai entrepreneurs submit a TTRS application form.',
                'icon' => '/assets/landing/img/register/1.png',
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/0001.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/0001.png',
                'cardcolor_id' => 1,
                'link' => 'servicepage'
            ],
            [
                'titlethai' => 'กรอกแบบฟอร์ม',
                'titleeng' => 'Complete the form',
                'descriptionthai' => 'กรอกแบบฟอร์มและส่งเอกสารเพิ่มเติมตามที่แจ้งในระบบ',
                'descriptioneng' => 'Complete the form and provide the requested documents.',
                'icon' => '/assets/landing/img/register/2.png',
                'link' => 'servicepage',
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/0002.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/0002.png',
                'cardcolor_id' => 2,
            ],
            [
                'titlethai' => 'พิจารณาเบื้องต้น',
                'titleeng' => 'Preliminary consideration',
                'descriptionthai' => 'ผู้เชี่ยวชาญพิจารณาเบื้องต้น',
                'descriptioneng' => 'The documents will then be verified by specialists.',
                'icon' => '/assets/landing/img/register/3.png',
                'link' => 'servicepage',
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/0003.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/0003.png',
                'cardcolor_id' => 3,
            ],
            [
                'titlethai' => 'ตรวจประเมิน',
                'titleeng' => 'Assessment',
                'descriptionthai' => 'ตรวจประเมินการใช้เทคโนโลยีในการผลิต',
                'descriptioneng' => "The entrepreneurs's project is then analyzed and evaluated based on its technology and innovation.",
                'icon' => '/assets/landing/img/register/4.png',
                'link' => 'servicepage',
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/0004.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/0004.png',
                'cardcolor_id' => 4,
            ],
            [
                'titlethai' => 'เข้าสู่ระบบประเมิน',
                'titleeng' => 'Assessment process',
                'descriptionthai' => 'เข้าสู่ระบบประเมิน TTRS',
                'descriptioneng' => "The project is introduced into TTRS assessment system.",
                'icon' => '/assets/landing/img/register/5.png',
                'link' => 'servicepage',
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/0005.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/0005.png',
                'cardcolor_id' => 5,
            ],
            [
                'titlethai' => 'แจ้งผลการประเมินและออกใบรับรอง',
                'titleeng' => 'Detemined result and awarded a certificate',
                'descriptionthai' => 'แจ้งผลการประเมิน ออกใบรับรองและผลวิเคราะห์ศักยภาพธุรกิจ',
                'descriptioneng' => 'Detemined result and awarded a certificate with a business performance analysis report.',
                'icon' => '/assets/landing/img/register/6.png',
                'link' => 'servicepage',
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/0007.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/0007.png',
                'cardcolor_id' => 6,
            ] 
        ]);
    }
}
