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
                'file' => '/assets/landing2/images/billboard.jpg',
                // 'entersitebtn' => '/assets/landing2/images/btn.png',
                'bgcolor' => '#60276b',
                'linkcss' => 'display: inline-block;margin-top: 5px;padding: 8px 20px;background: #017143;color: #fff;border-radius: 40px;font-weight: 500;letter-spacing: 1px;text-decoration: none;'
            ]
        ]);
    }
}