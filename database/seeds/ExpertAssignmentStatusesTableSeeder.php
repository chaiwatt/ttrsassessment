<?php

use Illuminate\Database\Seeder;

class ExpertAssignmentStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expert_assignment_statuses')->insert([
            [
                'name' => 'ยังไม่ได้ยืนยัน'
            ],
            [
                'name' => 'ยืนยันแล้ว'
            ],
            [
                'name' => 'ปฎิเสธ'
            ],
        ]);
    }
}