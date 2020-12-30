<?php

use Illuminate\Database\Seeder;

class EmployPositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employ_positions')->insert([
            [
                'name' => 'กรรมการผู้จัดการ (CEO)'
            ],
            [
                'name' => 'ผู้บริหารฝ่าย IT (CTO)'
            ],
            [
                'name' => 'ผู้บริหารฝ่ายการเงิน (CFO)'
            ],
            [
                'name' => 'ผู้บริหารฝ่ายปฎิบัติการ (COO)'
            ],
            [
                'name' => 'ผู้บริหารฝ่ายการตลาด (CMO)'
            ],
            [
                'name' => 'นักวิจัย'
            ],
            [
                'name' => 'วิศวกร'
            ],
            [
                'name' => 'นักพัฒนา'
            ],
            [
                'name' => 'นักการผลิต'
            ]
        ]);
    }
}
