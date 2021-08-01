<?php

use Illuminate\Database\Seeder;

class HomepagePillarSectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('homepage_pillar_sections')->insert([
            [
                'textth1' => 'ประเมินโครงการด้วยเกณฑ์ 4 เสา',
                'texteng1' => '4 PILLARS',
                'textth2' => 'ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS',
                'texteng2' => 'this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar',
                'titleth' => 'เกณฑ์การประเมิน',
                'titleen' => '4 Pillars Assessment',
                'detailth' => 'ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน',
                'detailen' => 'this the description about 4 pillar this the description about 4 pillar this the description',
                'pillartitleth1' => 'การจัดการ',
                'pillartitleeng1' => 'Management',
                'pillartitleth2' => 'เทคโนโลยี',
                'pillartitleeng2' => 'Technology',
                'pillartitleth3' => 'การตลาด',
                'pillartitleeng3' => 'Marketability',
                'pillartitleth4' => 'ความเป็นไปได้ทางธุรกิจ',
                'pillartitleeng4' => 'Business Prospect',
                'pillardescth1' => 'Management คำอธิบายภาษาไทย',
                'pillardesceng1' => 'Management description',
                'pillardescth2' => 'Technology คำอธิบายภาษาไทย',
                'pillardesceng2' => 'Technology description',
                'pillardescth3' => 'Marketability คำอธิบายภาษาไทย',
                'pillardesceng3' => 'Marketability description',
                'pillardescth4' => 'Business Prospect คำอธิบายภาษาไทย',
                'pillardesceng4' => 'Business Prospect description'
            ]
        ]);
    }
}
