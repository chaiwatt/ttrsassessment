<?php

use Illuminate\Database\Seeder;

class PillarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pillars')->insert([
            [
                'ev_type_id' => 1,
                'name' => 'การจัดการ',
                'percent' => 25
            ],
            [
                'ev_type_id' => 1,
                'name' => 'เทคโนโลยี',
                'percent' => 25
            ],
            [
                'ev_type_id' => 1,
                'name' => 'การตลาด',
                'percent' => 25
            ],
            [
                'ev_type_id' => 1,
                'name' => 'ธุรกิจ',
                'percent' => 25
            ],[
                'ev_type_id' => 2,
                'name' => 'การจัดการ',
                'percent' => 25
            ],
            [
                'ev_type_id' => 2,
                'name' => 'เทคโนโลยี',
                'percent' => 25
            ],
            [
                'ev_type_id' => 2,
                'name' => 'การตลาด',
                'percent' => 25
            ],
            [
                'ev_type_id' => 2,
                'name' => 'ธุรกิจ',
                'percent' => 25
            ]
        ]);
    }
}
