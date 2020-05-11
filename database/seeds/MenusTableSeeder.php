<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            [
                'parent_id' => 0,
                'name' => 'หน้าหลัก',
                'slug' => 'หน้าหลัก',
                'engname' => 'Home',
                'engslug' => 'home',
            ],
            [
                'parent_id' => 0,
                'name' => 'ข่าว',
                'slug' => 'ข่าว',
                'engname' => 'News',
                'engslug' => 'news',
            ],
            [
                'parent_id' => 0,
                'name' => 'ประกาศ',
                'slug' => 'ประกาศ',
                'engname' => 'Announce',
                'engslug' => 'announce',
            ],
            [
                'parent_id' => 0,
                'name' => 'งานบริการ',
                'slug' => 'งานบริการ',
                'engname' => 'Services',
                'engslug' => 'services',
            ],
            [
                'parent_id' => 0,
                'name' => 'เกี่ยวกับเรา',
                'slug' => 'เกี่ยวกับเรา',
                'engname' => 'About Us',
                'engslug' => 'aboutus',
            ],
            [
                'parent_id' => 0,
                'name' => 'ติดต่อเรา',
                'slug' => 'ติดต่อเรา',
                'engname' => 'Contact us',
                'engslug' => 'contactus',
            ]
        ]);
    }
}
