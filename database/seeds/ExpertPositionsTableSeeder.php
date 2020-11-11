<?php

use Illuminate\Database\Seeder;

class ExpertPositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expert_positions')->insert([
            [
                'name' => 'ผู้เชี่ยวชาญระดับ 1'
            ],
            [
                'name' => 'ผู้เชี่ยวชาญระดับ 2'
            ]
        ]);
    }
}
