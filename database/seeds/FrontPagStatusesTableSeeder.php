<?php

use Illuminate\Database\Seeder;

class FrontPagStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('front_page_statuses')->insert([
            [
                'name' => 'ปิดใช้ Billboard'
            ],
            [
                'name' => 'ใช้ Billboard'
            ]
        ]);
    }
}
