<?php

use Illuminate\Database\Seeder;

class HomePageIndustryUrlsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('home_page_industry_urls')->insert([
            [
                'url' => 'http://localhost/ttrsassessment/public/webpage/ผลการดำเนินงาน',
                'url_type' => 1,
            ]
        ]);
    }
}
