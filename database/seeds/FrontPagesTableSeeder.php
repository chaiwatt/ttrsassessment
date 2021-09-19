<?php

use Illuminate\Database\Seeder;

class FrontPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('front_pages')->insert([
            [
                'file' => '/assets/landing2/images/billboard.png',
                'entersitebtn' => '/assets/landing2/images/btn.png',
                'bgcolor' => '#60276b',
                'percentimg' => '60'
            ]
        ]);
    }
}