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
                'name' => 'เลขที่โครงการ'
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
            [
                'name' => 'Leader'
            ],
            [
                'name' => 'ผู้เชี่ยวชาญ'
            ],
            [
                 'name' => 'ชื่อบริษัท'
            ],
            [
                'name' => 'ทุนจดทะเบียน'
            ],
            [
                'name' => 'อื่นๆ'
            ],
        ]);
    }
}
