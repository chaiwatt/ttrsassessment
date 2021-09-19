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
                'titleth' => 'ผลการดำเนินงาน',
                'titleeng' => 'Project performance',
                'subtitleth' => 'ผลการดำเนินงานโครงการตามกลุ่มอุตสาหกรรม',
                'subtitleeng' => 'Project performance by Industry Group',
                'picture' => 'assets/landing2/images/about/group.png',
                'url' => 'performance',
       
            ]
        ]);
    }
}
