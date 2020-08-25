<?php

use Illuminate\Database\Seeder;

class EvTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ev_types')->insert([
            [
                'name' => 'INDEX',
                'percent' => 95
            ],
            [
                'name' => 'EXTRA',
                'percent' => 5
            ]
        ]);
    }
}
