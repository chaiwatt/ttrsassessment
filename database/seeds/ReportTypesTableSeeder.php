<?php

use Illuminate\Database\Seeder;

class ReportTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('report_types')->insert([
            [
                'name' => 'โครงการ (ภาพรวม)',
                'color' => 'info'
            ],
            [
                'name' => 'โครงการ (แยกตามธุรกิจและอุตสาหกรรม)',
                'color' => 'teal'
            ],
            [
                'name' => 'โครงการ (แยกตามภูมิภาคและจังหวัด)',
                'color' => 'purple'
            ],
            [
                'name' => 'โครงการ (ที่ประเมินแล้วเสร็จ)',
                'color' => 'blue'
            ],
            [
                'name' => 'MiniTBP',
                'color' => 'success'
            ],
            [
                'name' => 'FullTBP',
                'color' => 'pink'
            ],
            [
                'name' => 'สถานภาพโครงการ',
                'color' => 'violet'
            ],
            [
                'name' => 'On-Process',
                'color' => 'primary'
            ],
            [
                'name' => 'วัตถุประสงค์และผลการประเมิน',
                'color' => 'green'
            ],
            [
                'name' => 'โครงการ (ที่ขอยกเลิก)',
                'color' => 'warning'
            ],
            [
                'name' => 'TTRS STAFF',
                'color' => 'indigo'
            ],
            [
                'name' => 'Expert',
                'color' => 'orange'
            ],
            [
                'name' => 'Website',
                'color' => 'slate'
            ]

        ]);
    }
}
