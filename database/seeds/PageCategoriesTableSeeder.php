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
                'name' => 'หมวดหมู่ที่1',
                'slug' => 'หมวดหมู่ที่1'

            ],
            [
                'name' => 'หมวดหมู่ที่2',
                'slug' => 'หมวดหมู่ที่2'
            ]
        ]);
    }
}
