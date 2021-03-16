<?php

use Illuminate\Database\Seeder;

class HomepageServicesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('homepage_services')->insert([
            [
                'titlethai' => 'ยื่นใบสมัคร',
                'titleeng' => 'Registration process',
                'descriptionthai' => 'ผู้ประกอบการยื่นใบสมัครในระบบ TTRS',
                'descriptioneng' => 'English description for Registration process',
                'icon' => '/assets/landing/img/register/1.png',
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/1.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/1.png',
                'cardcolor' => '',
                'link' => ''
            ],
            [
                'titlethai' => 'กรอกแบบฟอร์ม',
                'titleeng' => 'Fill out the form',
                'descriptionthai' => 'กรอกแบบฟอร์มและส่งเอกสารเพิ่มเติมตามที่แจ้งในระบบ',
                'descriptioneng' => 'English description for Fill out the form',
                'icon' => '/assets/landing/img/register/2.png',
                'link' => '',
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/2.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/2.png',
                'cardcolor' => 'pink-bg',
            ],
            [
                'titlethai' => 'พิจารณาเบื้องต้น',
                'titleeng' => 'Preliminary consideration',
                'descriptionthai' => 'ผู้เชี่ยวชาญพิจารณาเบื้องต้น',
                'descriptioneng' => 'English description for Preliminary consideration',
                'icon' => '/assets/landing/img/register/3.png',
                'link' => '',
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/3.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/3.png',
                'cardcolor' => 'aqua-bg',
            ],
            [
                'titlethai' => 'ตรวจประเมิน',
                'titleeng' => 'Assessment',
                'descriptionthai' => 'ตรวจประเมินการใช้เทคโนโลยีและการประกอบธุรกิจ',
                'descriptioneng' => 'English description for Assessment',
                'icon' => '/assets/landing/img/register/4.png',
                'link' => '',
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/4.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/4.png',
                'cardcolor' => 'paste-bg',
            ],
            [
                'titlethai' => 'เข้าสู่ระบบการประเมิน',
                'titleeng' => 'Enter the assessment process',
                'descriptionthai' => 'เข้าสู่ระบบการประเมินเทคโนโลยี',
                'descriptioneng' => 'English description for Enter the assessment process',
                'icon' => '/assets/landing/img/register/5.png',
                'link' => '',
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/5.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/5.png',
                'cardcolor' => 'purple-bg',
            ],
            [
                'titlethai' => 'การจัดอันดับเทคโนโลยี',
                'titleeng' => 'Rating',
                'descriptionthai' => 'การจัดอันดับเทคโนโลยีและออกใบรับรอง',
                'descriptioneng' => 'English description for Rating',
                'icon' => '/assets/landing/img/register/6.png',
                'link' => '',
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/6.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/6.png',
                'cardcolor' => 'green-bg',
            ] 
        ]);
    }
}
