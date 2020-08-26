<?php

use Illuminate\Database\Seeder;

class IndexTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('index_types')->insert([
            [
                'name' => 'Grading'
            ],
            [
                'name' => 'Check List'
            ]
        ]);
    }
}
