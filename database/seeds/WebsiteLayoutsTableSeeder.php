<?php

use Illuminate\Database\Seeder;

class WebsiteLayoutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('website_layouts')->insert([
            [
                'order' => '1',
                'name' => 'ส่วนแสดงภาพสไลด์',
                'layout' => 'layouts.landing.slide',
                'status' => '1',
            ],
            [
                'order' => '2',
                'name' => 'ส่วนแสดง Intro section',
                'layout' => 'layouts.landing.introsection',
                'status' => '1',
            ],
            [
                'order' => '3',
                'name' => 'ส่วนแสดงเพจ',
                'layout' => 'layouts.landing.blog',
                'status' => '1',
            ],
            [
                'order' => '4',
                'name' => 'ส่วนแสดง Bottom',
                'layout' => 'layouts.landing.bottom',
                'status' => '1',
            ],
            [
                'order' => '5',
                'name' => 'ส่วนแสดง Html1',
                'layout' => 'layouts.landing.htmlone',
                'status' => '1',
            ],
            [
                'order' => '6',
                'name' => 'ส่วนแสดง Html2',
                'layout' => 'layouts.landing.htmltwo',
                'status' => '1',
            ],
            [
                'order' => '7',
                'name' => 'ส่วนแสดง Html3',
                'layout' => 'layouts.landing.htmlthree',
                'status' => '1',
            ]
            
        ]);
    }
}
