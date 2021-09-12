<?php

use Illuminate\Database\Seeder;

class DirectMenu2sTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('direct_menu2s')->insert([
            [
                'name' => 'หน้าหลัก',
                'slug' => 'หน้าหลัก',
                'engname' => 'Home',
                'engslug' => 'home',
                'menu_type_id' => 1,
                'submenu' => null,
                'url' => '#rs-header',
            ],
            [
                'name' => 'ข่าวสารและข้อมูล',
                'slug' => 'ข่าวสารและข้อมูล',
                'engname' => 'News',
                'engslug' => 'news',
                'menu_type_id' => 1,
                'submenu' => null,
                'url' => '#rs-blog',
            ],
            [
                'name' => 'บริการ',
                'slug' => 'บริการ',
                'engname' => 'Service',
                'engslug' => 'service',
                'menu_type_id' => 2,
                'submenu' => null,
                'url' => '#',
            ],
            [
                'name' => 'คำถามพบบ่อย',
                'slug' => 'คำถามพบบ่อย',
                'engname' => 'FAQ',
                'engslug' => 'faq',
                'menu_type_id' => 1,
                'submenu' => null,
                'url' => '#rs-faq',
            ],
            [
                'name' => 'ติดต่อเรา',
                'slug' => 'ติดต่อเรา',
                'engname' => 'Contact us',
                'engslug' => 'contactus',
                'menu_type_id' => 1,
                'submenu' => null,
                'url' => 'contact',
            ],
            [
                'name' => 'เข้าสู่ระบบ',
                'slug' => 'เข้าสู่ระบบ',
                'menu_type_id' => 1,
                'submenu' => null,
                'engname' => 'Login',
                'engslug' => 'LoginAndLogout',
                'url' => '#',
            ],
            [
                'name' => 'ขั้นตอนการบริการ',
                'slug' => 'ขั้นตอนการบริการ',
                'menu_type_id' => 3,
                'submenu' => 3,
                'engname' => 'Service procedure',
                'engslug' => 'service-procedure',
                'url' => '#rs-services-procedure',
            ],
            [
                'name' => 'แนะนำบริการ',
                'slug' => 'แนะนำบริการ',
                'menu_type_id' => 3,
                'submenu' => 3,
                'engname' => 'TTRS service',
                'engslug' => 'ttrs-service',
                'url' => '#rs-services-benefit',
            ],
            [
                'name' => 'ผลการดำเนินงาน',
                'slug' => 'ผลการดำเนินงาน',
                'menu_type_id' => 3,
                'submenu' => 3,
                'engname' => 'Project performance',
                'engslug' => 'project-performance',
                'url' => '#rs-performance',
            ]
        ]);
    }
}
