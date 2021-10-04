<?php

use Illuminate\Database\Seeder;

class HomePageServiceUrlsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('home_page_service_urls')->insert([
            [
                'url' => 'http://localhost/ttrsassessment/public/webpage/ขั้นตอนการบริการ',
                'url_type' => 1,
            ]
        ]);
    }
}
