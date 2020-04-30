<?php

use Illuminate\Database\Seeder;

class PageCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('page_categories')->insert([
            [
                'name' => 'อุตสาหกรรรม อาหาร',
                'slug' => 'อุตสาหกรรรม-อาหาร'

            ],
            [
                'name' => 'อุตสาหกรรรม เชื้อเพลิง',
                'slug' => 'อุตสาหกรรรม-เชื้อเพลิง'
            ]
        ]);
    }
}
