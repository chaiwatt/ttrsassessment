<?php

use Illuminate\Database\Seeder;

class EvaluationMonthsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('evaluation_months')->insert([
            [
                'name' => 'มกราคม'
            ],
            [
                'name' => 'กุมภาพันธ์'
            ],
            [
                'name' => 'มีนาคม'
            ],
            [
                'name' => 'เมษายน'
            ],
            [
                'name' => 'พฤษภาคม'
            ],
            [
                'name' => 'มิถุนายน'
            ],
            [
                'name' => 'กรกฎาคม'
            ],
            [
                'name' => 'สิงหาคม'
            ],
            [
                'name' => 'กันยายน'
            ],
            [
                'name' => 'ตุลาคม'
            ],
            [
                'name' => 'พฤศจิกายน'
            ],
            [
                'name' => 'ธันวาคม'
            ]
        ]);
    }
}
