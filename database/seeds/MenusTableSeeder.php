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
                'slug' => 'หน้าหลัก'
            ],
            [
                'parent_id' => 0,
                'name' => 'ข่าว',
                'slug' => 'ข่าว'
            ],
            [
                'parent_id' => 0,
                'name' => 'ประกาศ',
                'slug' => 'ประกาศ'
            ],
            [
                'parent_id' => 0,
                'name' => 'งานบริการ',
                'slug' => 'งานบริการ'
            ],
            [
                'parent_id' => 0,
                'name' => 'เกี่ยวกับเรา',
                'slug' => 'เกี่ยวกับเรา'
            ],
            [
                'parent_id' => 0,
                'name' => 'ติดต่อเรา',
                'slug' => 'ติดต่อเรา'
            ]
        ]);
    }
}

