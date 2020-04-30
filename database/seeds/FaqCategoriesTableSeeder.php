<?php

use Illuminate\Database\Seeder;

class FaqCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faq_categories')->insert([
            [
                'name' => 'มาตรฐานการรับรอง'
    
            ],
    
            [
                'name' => 'กฎหมายระเบียบข้อบังคับ'
            ],
    
            [
                'name' => 'ความรู้ทั่วไป'
            ]
        ]);

    }
}
