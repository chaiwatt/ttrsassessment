<?php

use Illuminate\Database\Seeder;

class HomePagePillarUrlsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('home_page_pillar_urls')->insert([
            [
                'url' => 'http://localhost/ttrsassessment/public/webpage/แนะนำบริการ',
                'url_type' => 1,
            ]
        ]);
    }
}
