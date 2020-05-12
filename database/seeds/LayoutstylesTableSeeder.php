<?php

use Illuminate\Database\Seeder;

class LayoutstylesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('layout_styles')->insert([
            [
                'name' => 'กล่อง'
            ],
            [
                'name' => 'กว้าง'
            ]
        ]);
    }
}
