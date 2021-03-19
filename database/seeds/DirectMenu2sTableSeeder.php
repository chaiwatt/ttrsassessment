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
                'name' => 'บริการ',
                'slug' => 'บริการ',
                'engname' => 'Service',
                'engslug' => 'service',
                'url' => '#rs-services',
            ],
            [
                'name' => 'กลุ่มอุตสาหกรรม',
                'slug' => 'กลุ่มอุตสาหกรรม',
                'engname' => 'Industry group',
                'engslug' => 'industrygroup',
                'url' => '#rs-industrygrop',
            ],
            [
                'name' => 'ข่าว',
                'slug' => 'ข่าว',
                'engname' => 'News',
                'engslug' => 'news',
                'url' => '#rs-blog',
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
            ]
        ]);
    }
}
