<?php

use Illuminate\Database\Seeder;

class ProjectFlowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_flows')->insert([
            [
                'name' => 'การมอบหมาย Leader และ Co -Lead',
                'duration' => 6
            ],
            [
                'name' => 'การพิจารณา Mini TBP',
                'duration' => 6
            ],
            [
                'name' => 'การพิจารณา Full TBP, การนำเสนอ Expert และการพัฒนา EV',
                'duration' => 25
            ],
            [
                'name' => 'การนัดหมายลงประเมิน',
                'duration' => 3
            ],
            [
                'name' => 'การประเมินให้คะแนน และสรุปผล',
                'duration' => 5
            ],
            [
                'name' => 'ส่งผลการประเมินทางEmail /ระบบ',
                'duration' => 1
            ],
            [
                'name' => 'ส่งจม.แจ้งผลทางการ และใบ CER',
                'duration' => 7
            ],
            [
                'name' => 'โครงการประเมินแล้วเสร็จสิ้น/ระบุรายละเอียด',
                'duration' => 1
            ]
        ]);
    }
}
