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
                'name' => 'ยังไม่ได้ตั้งค่า Profile',
                'progress' => 0
            ],
            [
                'name' => 'ให้พัฒนา Mini TBP',
                'progress' => 5
            ],
            [
                'name' => 'อยู่ระหว่างการพิจารณา Mini TBP',
                'progress' => 10
            ],
            [
                'name' => 'อยู่ระหว่างการพัฒนา Full TBP',
                'progress' => 20
            ],
            [
                'name' => 'อยู่ระหว่างการพิจารณา Full TBP',
                'progress' => 30
            ],
            [
                'name' => 'อยู่ระหว่างการนัดหมายการประเมิน',
                'progress' => 50
            ],
            [
                'name' => 'อยู่ระหว่างการพิจารณาผลการประเมิน',
                'progress' => 70
            ],
            [
                'name' => 'อยู่ระหว่างรอการชำระเงินค่าธรรมเนียม',
                'progress' => 80
            ],
            [
                'name' => 'อยู่ระหว่างการแจ้งผลการประเมิน',
                'progress' => 90
            ],
            [
                'name' => 'สิ้นสุดโครงการ',
                'progress' => 100
            ],
        ]);
    }
}

   