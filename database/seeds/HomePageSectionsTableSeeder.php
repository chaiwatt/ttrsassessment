<?php

use Illuminate\Database\Seeder;

class HomePageSectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('home_page_sections')->insert([
            [
                'order_list' => 1,
                'name' => 'layouts.landing2.services',
                'anchore' => 'rs-services-procedure',
                'aliasname' => 'ขั้นตอนการบริการ',
                'editurl' => 'setting/admin/website/homepage/service',
                'show' => 1
            ],
            [
                'order_list' => 2,
                'name' => 'layouts.landing2.industrygroup',
                'anchore' => 'rs-performance',
                'aliasname' => 'ผลการดำเนินงาน',
                'editurl' => 'setting/admin/website/homepage/industryugroup',
                'show' => 1
            ],
            [
                'order_list' => 3,
                'name' => 'layouts.landing2.pillars',
                'anchore' => 'rs-services-benefit',
                'aliasname' => 'แนะนำบริการ',
                'editurl' => 'setting/admin/website/homepage/pillar/edit',
                'show' => 1
            ],
            [
                'order_list' => 4,
                'name' => 'layouts.landing2.blogs',
                'anchore' => 'rs-blog',
                'aliasname' => 'ข่าวสารและข้อมูล',
                'editurl' => 'setting/admin/website/page',
                'show' => 1
            ],
            [
                'order_list' => 5,
                'name' => 'layouts.landing2.faq',
                'anchore' => 'rs-faq',
                'aliasname' => 'คำถามพบบ่อย',
                'editurl' => 'setting/admin/website/homepage/faq',
                'show' => 1
            ],
            [
                'order_list' => 6,
                'name' => 'layouts.landing2.htmlsection1',
                'anchore' => 'custom-section1',
                'aliasname' => 'custom section1',
                'editurl' => 'setting/admin/website/homepage/customsection/edit/6',
                'show' => 0
            ],
            [
                'order_list' => 7,
                'name' => 'layouts.landing2.htmlsection2',
                'anchore' => 'custom-section2',
                'aliasname' => 'custom section2',
                'editurl' => 'setting/admin/website/homepage/customsection/edit/7',
                'show' => 0
            ],
            [
                'order_list' => 8,
                'name' => 'layouts.landing2.htmlsection3',
                'anchore' => 'custom-section3',
                'aliasname' => 'custom section3',
                'editurl' => 'setting/admin/website/homepage/customsection/edit/8',
                'show' => 0
            ],
            [
                'order_list' => 9,
                'name' => 'layouts.landing2.htmlsection4',
                'anchore' => 'custom-section4',
                'aliasname' => 'custom section4',
                'editurl' => 'setting/admin/website/homepage/customsection/edit/9',
                'show' => 0
            ],
            [
                'order_list' => 10,
                'name' => 'layouts.landing2.htmlsection5',
                'anchore' => 'custom-section5',
                'aliasname' => 'custom section5',
                'editurl' => 'setting/admin/website/homepage/customsection/edit/10',
                'show' => 0
            ],
        ]);
    }
}
