<?php

use Illuminate\Database\Seeder;

class CompanysizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companysizes')->insert([
            [
                'name' => 'Micro'
            ],
            [
                'name' => 'S'
            ],
            [
                'name' => 'M'
            ],
            [
                'name' => 'L'
            ]
        ]);
    }
}
