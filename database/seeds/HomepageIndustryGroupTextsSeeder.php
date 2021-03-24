<?php

use Illuminate\Database\Seeder;

class HomepageIndustryGroupTextsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('homepage_industry_group_texts')->insert([
            [
                'titleth' => 'กลุ่มอุตสาหกรรมที่ขอรับการประเมิน',
                'titleeng' => 'Industry group',
                'subtitleth' => 'กลุ่มอุตสาหกรรมที่ขอรับการประเมิน',
                'subtitleeng' => 'Industry group description',
                'picture' => 'assets/landing2/images/about/group.png',
                'url' => 'register'
            ]
        ]);
    }
}
