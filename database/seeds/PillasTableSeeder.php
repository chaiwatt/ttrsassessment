<?php

use Illuminate\Database\Seeder;

class PillasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pillas')->insert([
            [
                'name' => 'การจัดการ',
                'percent' => 25
            ],
            [
                'name' => 'เทคโนโลยี',
                'percent' => 25
            ],
            [
                'name' => 'การตลาด',
                'percent' => 25
            ],
            [
                'name' => 'ธุรกิจ',
                'percent' => 25
            ]
        ]);
    }
}
