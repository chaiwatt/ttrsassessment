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
                'duration' => 3
            ],
            [
                'name' => 'การอนุมัติ Mini TBP',
                'duration' => 3
            ],
            [
                'name' => 'การอนุมัติ Full TBP, การมอบหมายผู้เชี่ยวชาญ, การพัฒนา EV',
                'duration' => 26
            ],
            [
                'name' => 'การนัดหมายเพื่อประเมิน ณ สถานประกอบการ',
                'duration' => 6
            ],
            [
                'name' => 'การประเมินให้คะแนน และสรุปผล',
                'duration' => 5
            ],
            [
                'name' => 'ส่งผลการประเมินทางEmail /ระบบ',
                'duration' => 2
            ],
            [
                'name' => 'ส่งจดหมายแจ้งผลทางการ และพิมพ์ CERTIFICATE',
                'duration' => 6
            ],
            [
                'name' => 'โครงการประเมินแล้วเสร็จสิ้น/ระบุรายละเอียด',
                'duration' => 2
            ]
        ]);
    }
}
