<?php

use Illuminate\Database\Seeder;

class ExtraCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('extra_categories')->insert([
            [
                'name' => 'อย.'
            ],
            [
                'name' => 'มอก.'
            ],
            [
                'name' => 'Bank'
            ]
        ]);
    }
}
