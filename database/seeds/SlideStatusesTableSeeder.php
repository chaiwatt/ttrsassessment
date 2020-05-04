<?php

use Illuminate\Database\Seeder;

class SlideStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slide_statuses')->insert([
            [
                'name' => 'เปิดใช้ style'
            ],
            [
                'name' => 'ปิดใช้ style'
            ]
        ]);
    }
}
