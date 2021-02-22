<?php

use Illuminate\Database\Seeder;

class AnnounceCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('announce_categories')->insert([
            [
                'name' => 'ประกวดราคา'
            ],
            [
                'name' => 'ประกาศจัดซื้อจัดจ้าง'
            ],
            [
                'name' => 'ประกาศรับสมัครงาน'
            ],
            [
                'name' => 'ประกาศทั่วไป'
            ]
        ]);
    }
}
