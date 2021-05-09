<?php

use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->insert([
            [
                'name' => 'AAA',
                'min' => 87,
                'max' => 100,
            ],
            [
                'name' => 'AA',
                'min' => 80,
                'max' => 87,
            ],
            [
                'name' => 'A',
                'min' => 74,
                'max' => 80,
            ],
            [
                'name' => 'BBB',
                'min' => 70,
                'max' => 74,
            ],
            [
                'name' => 'BB',
                'min' => 64,
                'max' => 70,
            ],
            [
                'name' => 'B',
                'min' => 56,
                'max' => 64,
            ],
            [
                'name' => 'CCC',
                'min' => 54,
                'max' => 56,
            ],
            [
                'name' => 'CC',
                'min' => 51,
                'max' => 54,
            ],
            [
                'name' => 'C',
                'min' => 48,
                'max' => 51,
            ],
            [
                'name' => 'D',
                'min' => 25,
                'max' => 48,
            ],
            [
                'name' => 'E',
                'min' => 0,
                'max' => 25,
            ]
        ]);
    }
}
