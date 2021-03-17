<?php

use Illuminate\Database\Seeder;

class HeaderTextsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('header_texts')->insert([
            [
                'titleth' => 'Thailand Technology Rating Support and Service (TTRS)',
                'titleeng' => 'Thailand Technology Rating Support and Service (TTRS)',
                'detailth' => 'ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS',
                'detaileng' => 'Thailand Technology Rating Support and Service (TTRS), By NSTDA',
            ]
        ]);
    }
}
