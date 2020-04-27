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
                'name' => 'รอการยืนยันการรับการประเมิน'
            ],
            [
                'name' => 'รอผลการประเมิน'
            ],
            [
                'name' => 'ไม่ผ่านการประเมิน'
            ],
            [
                'name' => 'ผ่านการประเมิน'
            ]
        ]);
    }
}
   