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
                'url' => '#rs-header',
            ],
            [
                'name' => 'ข่าวสารและข้อมูล',
                'slug' => 'ข่าวสารและข้อมูล',
                'engname' => 'News',
                'engslug' => 'news',
                'url' => '#rs-blog',
            ],
            [
                'name' => 'แนะนำบริการ',
                'slug' => 'แนะนำบริการ',
                'engname' => 'Service',
                'engslug' => 'service',
                'url' => '#rs-services',
            ],
            [
                'name' => 'ผลการดำเนินงาน',
                'slug' => 'ผลการดำเนินงาน',
                'engname' => 'Assessment',
                'engslug' => 'Assessment',
                'url' => '#rs-industrygrop',
            ],
            [
                'name' => 'คำถามพบบ่อย',
                'slug' => 'คำถามพบบ่อย',
                'engname' => 'FAQ',
                'engslug' => 'faq',
                'url' => '#rs-faq',
            ],
            [
                'name' => 'ติดต่อเรา',
                'slug' => 'ติดต่อเรา',
                'engname' => 'Contact us',
                'engslug' => 'contactus',
                'url' => '#rs-contact',
            ],
            [
                'name' => 'เข้าสู่ระบบ',
                'slug' => 'เข้าสู่ระบบ',
                'engname' => 'LoginAndLogout',
                'engslug' => 'LoginAndLogout',
                'url' => '#',
            ]
        ]);
    }
}
