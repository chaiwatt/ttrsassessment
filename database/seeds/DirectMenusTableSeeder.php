<?php

use Illuminate\Database\Seeder;

class DirectMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('direct_menus')->insert([
            [
                'name' => 'หน้าหลัก',
                'slug' => 'หน้าหลัก',
                'engname' => 'Home',
                'engslug' => 'home',
            ],
            [
                'name' => 'ข่าว',
                'slug' => 'ข่าว',
                'engname' => 'News',
                'engslug' => 'news',
            ],
            [
                'name' => 'ประกาศ',
                'slug' => 'ประกาศ',
                'engname' => 'Announce',
                'engslug' => 'announce',
            ],
            [
                'name' => 'งานบริการ',
                'slug' => 'งานบริการ',
                'engname' => 'Services',
                'engslug' => 'services',
            ],
            [
                'name' => 'เกี่ยวกับเรา',
                'slug' => 'เกี่ยวกับเรา',
                'engname' => 'About Us',
                'engslug' => 'aboutus',
            ],
            [
                'name' => 'ติดต่อเรา',
                'slug' => 'ติดต่อเรา',
                'engname' => 'Contact us',
                'engslug' => 'contactus',
            ]
        ]);
    }
}
