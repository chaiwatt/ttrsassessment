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
                'name' => 'อยู่ระหว่างการตรวจสอบ',
                'progress' => 5
            ],
            [
                'name' => 'ให้ส่ง Mini TBP',
                'progress' => 10
            ],
            [
                'name' => 'อยู่ระหว่างพิจารณา Mini TBP',
                'progress' => 15
            ],
            [
                'name' => 'ให้ส่ง Full TBP',
                'progress' => 20
            ],
            [
                'name' => 'อยู่ระหว่างพิจารณา Full TBP',
                'progress' => 25
            ],
            [
                'name' => 'รอนัดหมายการประเมิน',
                'progress' => 35
            ],
            [
                'name' => 'อยู่ระหว่างการพิจารณา',
                'progress' => 45
            ],
            [
                'name' => 'รอผลการประเมิน',
                'progress' => 60
            ],
            [
                'name' => 'รอการชำระเงินค่าธรรมเนียม',
                'progress' => 70
            ],
            [
                'name' => 'ผ่านการประเมิน',
                'progress' => 100
            ],
        ]);
    }
}

   