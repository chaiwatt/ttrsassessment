<?php

use Illuminate\Database\Seeder;

class MiniTbpSubmitStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mini_tbp_submit_statuses')->insert([
            [
                'name' => 'ไม่ส่ง'
            ],
            [
                'name' => 'ส่งแล้ว'
            ]
        ]);
    }
}
