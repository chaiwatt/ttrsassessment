<?php

use Illuminate\Database\Seeder;

class CardColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('card_colors')->insert([
            [
                'name' => 'default'
            ],
            [
                'name' => 'pink-bg'
            ],
            [
                'name' => 'aqua-bg'
            ],
            [
                'name' => 'paste-bg'
            ],
            [
                'name' => 'purple-bg'
            ],
            [
                'name' => 'green-bg'
            ]
        ]);
    }
}
