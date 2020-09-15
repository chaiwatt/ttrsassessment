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
                'name' => 'A',
                'value' => 5
            ],
            [
                'name' => 'B',
                'value' => 4
            ],
            [
                'name' => 'C',
                'value' => 3
            ],
            [
                'name' => 'D',
                'value' => 2
            ],
            [
                'name' => 'E',
                'value' => 1
            ]
        ]);
    }
}
