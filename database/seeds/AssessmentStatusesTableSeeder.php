<?php

use Illuminate\Database\Seeder;

class AssessmentStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assessment_statuses')->insert([
            [
                'name' => 'ไม่ให้รับการประเมิน'
            ],
            [
                'name' => 'รอการประเมิน'
            ],
            [
                'name' => 'รอการประเมิน'
            ],
            [
                'name' => 'กำลังประเมิน'
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
