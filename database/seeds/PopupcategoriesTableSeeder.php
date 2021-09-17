<?php

use Illuminate\Database\Seeder;

class PopupcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('popup_categories')->insert([
            [
                'name' => 'Mini TBP',
            ],
            [
                'name' => 'Full TBP',
            ],
            [
                'name' => 'การมอบหมายผู้เชี่ยวชาญ',
            ],
            [
                'name' => 'EV',
            ],
            [
                'name' => 'ปฏิทิน',
            ],
            [
                'name' => 'BOL',
            ],
            [
                'name' => 'การประเมิน',
            ]
        ]);
    }
}
