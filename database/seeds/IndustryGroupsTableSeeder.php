<?php

use Illuminate\Database\Seeder;

class IndustryGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('industry_groups')->insert([
            [
                'name' => 'อุตสาหกรรมยานยนต์สมัยใหม่ (Next-generation Automotive)'
            ],
            [
                'name' => 'อุตสาหกรรมอิเล็กทรอนิกส์อัจฉริยะ (Smart Electronics)'
            ],
            [
                'name' => 'อุตสาหกรรมการท่องเที่ยวกลุ่มรายได้ดีและการท่องเที่ยวเชิงสุขภาพ (Affluent, Medical and Wellness Tourism)'
            ],
            [
                'name' => 'การเกษตรและเทคโนโลยีชีวภาพ (Agriculture and Biotechnology)'
            ],
            [
                'name' => 'อุตสาหกรรมการแปรรูปอาหาร (Food for the Future)'
            ],
            [
                'name' => 'อุตสาหกรรมหุ่นยนต์เพื่อการอุตสาหกรรม (Robotics)'
            ],
            [
                'name' => 'อุตสาหกรรมการบินและโลจิสติกส์ (Aviation and Logistics)'
            ],
            [
                'name' => 'อุตสาหกรรมเชื้อเพลิงชีวภาพและเคมีชีวภาพ (Biofuels and Biochemicals)'
            ],
            [
                'name' => 'อุตสาหกรรมดิจิทัล (Digital)'
            ],
            [
                'name' => 'อุตสาหกรรมการแพทย์ครบวงจร (Medical Hub)'
            ],
            [
                'name' => 'อุตสาหกรรมป้องกันประเทศ (Defense)'
            ],
            [
                'name' => 'อุตสาหกรรมการศึกษาและพัฒนาทักษะ (Education and Skill Development)'
            ],
            [
                'name' => 'อื่นๆ'
            ],
        ]);
    }
}
