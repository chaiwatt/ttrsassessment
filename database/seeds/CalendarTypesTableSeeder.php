<?php

use Illuminate\Database\Seeder;

class CalendarTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calendar_types')->insert([
            [
                'name' => 'นัดประชุม (briefing) ก่อนลงพื้นที่'
            ],
            [
                'name' => 'นัดหมายการประเมิน'
            ],
            [
                'name' => 'นัดหมายสรุปผลการประเมิน'
            ],
            [
                'name' => 'อื่น ๆ'
            ]
        ]);
    }
}
