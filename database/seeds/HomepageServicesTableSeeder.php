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
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/01.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/01.png',
                'cardcolor_id' => 1,
                'link' => 'servicepage'
            ],
            [
                'titlethai' => 'กรอกแบบฟอร์ม',
                'titleeng' => 'Fill out the form',
                'descriptionthai' => 'กรอกแบบฟอร์มและส่งเอกสารเพิ่มเติมตามที่แจ้งในระบบ',
                'descriptioneng' => 'English description for Fill out the form',
                'icon' => '/assets/landing/img/register/2.png',
                'link' => 'servicepage',
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/02.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/02.png',
                'cardcolor_id' => 2,
            ],
            [
                'titlethai' => 'พิจารณาเบื้องต้น',
                'titleeng' => 'Preliminary consideration',
                'descriptionthai' => 'ผู้เชี่ยวชาญพิจารณาเบื้องต้น',
                'descriptioneng' => 'English description for Preliminary consideration',
                'icon' => '/assets/landing/img/register/3.png',
                'link' => 'servicepage',
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/03.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/03.png',
                'cardcolor_id' => 3,
            ],
            [
                'titlethai' => 'ตรวจประเมิน',
                'titleeng' => 'Assessment',
                'descriptionthai' => 'ตรวจประเมินการใช้เทคโนโลยีและการประกอบธุรกิจ',
                'descriptioneng' => 'English description for Assessment',
                'icon' => '/assets/landing/img/register/4.png',
                'link' => 'servicepage',
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/04.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/04.png',
                'cardcolor_id' => 4,
            ],
            [
                'titlethai' => 'เข้าสู่ระบบการประเมิน',
                'titleeng' => 'Enter the assessment process',
                'descriptionthai' => 'เข้าสู่ระบบการประเมินเทคโนโลยี',
                'descriptioneng' => 'English description for Enter the assessment process',
                'icon' => '/assets/landing/img/register/5.png',
                'link' => 'servicepage',
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/05.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/05.png',
                'cardcolor_id' => 5,
            ],
            [
                'titlethai' => 'การจัดอันดับเทคโนโลยี',
                'titleeng' => 'Rating',
                'descriptionthai' => 'การจัดอันดับเทคโนโลยีและออกใบรับรอง',
                'descriptioneng' => 'English description for Rating',
                'icon' => '/assets/landing/img/register/6.png',
                'link' => 'servicepage',
                'iconnormal' => '/assets/landing2/images/services/style2/main-img/06.png',
                'iconhover' => '/assets/landing2/images/services/style2/hover-img/06.png',
                'cardcolor_id' => 6,
            ] 
        ]);
    }
}
