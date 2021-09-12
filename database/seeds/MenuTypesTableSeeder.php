<?php

use Illuminate\Database\Seeder;

class MenuTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_types')->insert([
            [
                'name' => 'No Child'
            ],
            [
                'name' => 'Parent'
            ],
            [
                'name' => 'Child'
            ]
        ]);
    }
}
