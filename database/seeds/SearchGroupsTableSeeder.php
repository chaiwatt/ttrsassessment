<?php

use Illuminate\Database\Seeder;

class SearchGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('search_groups')->insert([
            [
                'name' => 'ปีของโครงการ'
            ],
            [
                'name' => 'เลขที่โครงการ/Mini TBP/Full Tbp'
            ],
            [
                'name' => 'ชื่อโครงการ'
            ],
            [
                'name' => 'รหัส ISIC'
            ],
            [
                'name' => 'กลุ่มอุตสาหกรรม'
            ],
            [
                'name' => 'เกรด'
            ],
            // [
            //     'name' => 'เลขที่ใบรับรอง'
            // ],
            [
                'name' => 'Leader'
            ],
            [
                'name' => 'ผู้เชี่ยวชาญ'
            ],
            [
                'name' => 'แบบคำขอรับบริการประเมิน TTRS (Mini TBP)'
            ],
            [
                'name' => 'แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)'
            ],
            [
                'name' => 'วันที่ประเมิน'
            ],
            [
                'name' => 'ทั้งหมด'
            ],
        ]);
    }
}
