<?php

use Illuminate\Database\Seeder;

class HomepagePillarsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('homepage_pillars')->insert([
            [
                'headerthai' => 'เสาหลัก',
                'headereng' => 'PILLARS',
                'descriptionthai' => 'คำอธิบายว่าการประเมินเป็นอย่างไร แยกเป็น pillar คำอธิบายว่าการประเมินเป็นอย่างไร แยกเป็น pillar คำอธิบายว่าการประเมินเป็นอย่างไร แยกเป็น pillar คำอธิบายว่าการประเมินเป็นอย่างไร แยกเป็น pillar',
                'descriptioneng' => 'Describe about assessment including the pillars deails Describe about assessment including the pillars deails Describe about assessment including the pillars deails',
                'pillarimage1' => '/assets/landing/img/4p/01.png',
                'pillarimage2' => '/assets/landing/img/4p/02.png',
                'pillarimage3' => '/assets/landing/img/4p/03.png',
                'pillarimage4' => '/assets/landing/img/4p/04.png',
                'pillarheader1' => 'Management',
                'pillarheader2' => 'Technology',
                'pillarheader3' => 'Marketability',
                'pillarheader4' => 'Business Prospect',
                'pillardescriptionthai1' => 'Management คำอธิบายภาษาไทย',
                'pillardescriptioneng1' => 'Management description in english',
                'pillardescriptionthai2' => 'Technology คำอธิบายภาษาไทย',
                'pillardescriptioneng2' => 'Technology description in english',
                'pillardescriptionthai3' => 'Marketability คำอธิบายภาษาไทย',
                'pillardescriptioneng3' => 'Marketability description in english',
                'pillardescriptionthai4' => 'Business Prospect คำอธิบายภาษาไทย',
                'pillardescriptioneng4' => 'Business Prospect description in english',
            ]
        ]);
    }
}
