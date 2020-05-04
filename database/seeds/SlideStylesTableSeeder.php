<?php

use Illuminate\Database\Seeder;

class SlideStylesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slide_styles')->insert([
            [
                'name' => 'styleที่ 1'
            ],
            [
                'name' => 'styleที่ 2'
            ]
        ]);
    }
}
