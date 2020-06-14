<?php

use Illuminate\Database\Seeder;

class BusinessPlanStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_plan_statuses')->insert([
            [
                'name' => 'รอการยืนยันให้การประเมิน',
                'progress' => 5
            ],
            [
                'name' => 'ให้ส่ง mini TBP',
                'progress' => 10
            ],
            [
                'name' => 'อยู่ระหว่างพิจารณา mini TBP',
                'progress' => 15
            ],
            [
                'name' => 'ให้ส่ง FUll TBP',
                'progress' => 20
            ],
            [
                'name' => 'อยู่ระหว่างพิจารณา Full TBP',
                'progress' => 25
            ],
            [
                'name' => 'รอผลการประเมิน',
                'progress' => 80
            ],
            [
                'name' => 'รอการชำระเงินค่าธรรมเนียม',
                'progress' => 90
            ],
            [
                'name' => 'ผ่านการประเมิน',
                'progress' => 100
            ],
        ]);
    }
}
   