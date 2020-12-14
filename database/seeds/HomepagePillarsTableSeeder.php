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
                'pillarimage1' => '/assets/landing/img/4p/1.png',
                'pillarimage2' => '/assets/landing/img/4p/2.png',
                'pillarimage3' => '/assets/landing/img/4p/3.png',
                'pillarimage4' => '/assets/landing/img/4p/4.png',
            ]
        ]);
    }
}
