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
                'textth1' => '4 PILLARS',
                'texteng1' => '4 PILLARS',
                'textth2' => '4 หมวดการประเมิน',
                'texteng2' => '4 PILLARS',
                'pillartitleth1' => 'Management',
                'pillartitleeng1' => 'Management',
                'pillartitleth2' => 'Technology',
                'pillartitleeng2' => 'Technology',
                'pillartitleth3' => 'Marketability',
                'pillartitleeng3' => 'Marketability',
                'pillartitleth4' => 'Business Prospect',
                'pillartitleeng4' => 'Business Prospect',
                'pillardescth1' => 'Management คำอธิบายภาษาไทย',
                'pillardesceng1' => 'Management description',
                'pillardescth2' => 'Technology คำอธิบายภาษาไทย',
                'pillardesceng2' => 'Technology description',
                'pillardescth3' => 'Marketability คำอธิบายภาษาไทย',
                'pillardesceng3' => 'Marketability description',
                'pillardescth4' => 'Business Prospect คำอธิบายภาษาไทย',
                'pillardesceng4' => 'Business Prospect description'
            ]
        ]);
    }
}
