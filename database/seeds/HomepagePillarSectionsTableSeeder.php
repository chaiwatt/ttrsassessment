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
                'textth1' => 'แนะนำบริการ',
                'texteng1' => 'TTRS Service',
                'textth2' => 'ระบบการประเมินเทคโนโลยีของผู้ประกอบการ ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS',
                'texteng2' => 'this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar this the description about 4 pillar',
                'titleth' => 'เกณฑ์การประเมิน',
                'titleen' => '4 Pillars Assessment',
                'detailth' => 'ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน',
                'detailen' => 'this the description about 4 pillar this the description about 4 pillar this the description',
                'pillartitleth1' => 'การบริหารจัดการ',
                'pillartitleeng1' => 'Management',
                'pillaricon1' => 'assets/dashboard/images/pillar/ttrs-05.png',
                'pillartitleth2' => 'เทคโนโลยีและนวัตกรรม',
                'pillartitleeng2' => 'Technology & Innovation',
                'pillaricon2' => 'assets/dashboard/images/pillar/ttrs-06.png',
                'pillartitleth3' => 'ความสามารถด้านการตลาด',
                'pillartitleeng3' => 'Marketability',
                'pillaricon3' => 'assets/dashboard/images/pillar/ttrs-07.png',
                'pillartitleth4' => 'ความเป็นไปได้ทางธุรกิจ',
                'pillartitleeng4' => 'Business Prospect',
                'pillaricon4' => 'assets/dashboard/images/pillar/ttrs-08.png',
                'pillardescth1' => 'Management คำอธิบายภาษาไทย',
                'pillardesceng1' => 'Management description',
                'pillardescth2' => 'Technology คำอธิบายภาษาไทย',
                'pillardesceng2' => 'Technology description',
                'pillardescth3' => 'Marketability คำอธิบายภาษาไทย',
                'pillardesceng3' => 'Marketability description',
                'pillardescth4' => 'Business Prospect คำอธิบายภาษาไทย',
                'pillardesceng4' => 'Business Prospect description',
            ]
        ]);
    }
}
