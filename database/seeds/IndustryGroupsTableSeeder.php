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
                'name' => 'อุตสาหกรรมยานยนต์สมัยใหม่ (Next-generation Automotive)',
                'nameth' => 'อุตสาหกรรมยานยนต์สมัยใหม่',
                'nameeng' => 'Next-generation Automotive'
            ],
            [
                'name' => 'อุตสาหกรรมอิเล็กทรอนิกส์อัจฉริยะ (Smart Electronics)',
                'nameth' => 'อุตสาหกรรมอิเล็กทรอนิกส์อัจฉริยะ',
                'nameeng' => 'Smart Electronics'
            ],
            [
                'name' => 'อุตสาหกรรมการท่องเที่ยวกลุ่มรายได้ดีและการท่องเที่ยวเชิงสุขภาพ (Affluent, Medical and Wellness Tourism)',
                'nameth' => 'อุตสาหกรรมการท่องเที่ยวกลุ่มรายได้ดีและการท่องเที่ยวเชิงสุขภาพ',
                'nameeng' => 'Affluent, Medical and Wellness Tourism'
            ],
            [
                'name' => 'การเกษตรและเทคโนโลยีชีวภาพ (Agriculture and Biotechnology)',
                'nameth' => 'การเกษตรและเทคโนโลยีชีวภาพ',
                'nameeng' => 'Agriculture and Biotechnology'
            ],
            [
                'name' => 'อุตสาหกรรมการแปรรูปอาหาร (Food for the Future)',
                'nameth' => 'อุตสาหกรรมการแปรรูปอาหาร',
                'nameeng' => 'Food for the Future'
            ],
            [
                'name' => 'อุตสาหกรรมหุ่นยนต์เพื่อการอุตสาหกรรม (Robotics)',
                'nameth' => 'อุตสาหกรรมหุ่นยนต์เพื่อการอุตสาหกรรม',
                'nameeng' => 'Robotics'
            ],
            [
                'name' => 'อุตสาหกรรมการบินและโลจิสติกส์ (Aviation and Logistics)',
                'nameth' => 'อุตสาหกรรมการบินและโลจิสติกส์',
                'nameeng' => 'Aviation and Logistics'
            ],
            [
                'name' => 'อุตสาหกรรมเชื้อเพลิงชีวภาพและเคมีชีวภาพ (Biofuels and Biochemicals)',
                'nameth' => 'อุตสาหกรรมเชื้อเพลิงชีวภาพและเคมีชีวภาพ',
                'nameeng' => 'Biofuels and Biochemicals'
            ],
            [
                'name' => 'อุตสาหกรรมดิจิทัล (Digital)',
                'nameth' => 'อุตสาหกรรมดิจิทัล',
                'nameeng' => 'Digital'
            ],
            [
                'name' => 'อุตสาหกรรมการแพทย์ครบวงจร (Medical Hub)',
                'nameth' => 'อุตสาหกรรมการแพทย์ครบวงจร',
                'nameeng' => 'Medical Hub'
            ],
            [
                'name' => 'อุตสาหกรรมป้องกันประเทศ (Defense)',
                'nameth' => 'อุตสาหกรรมป้องกันประเทศ',
                'nameeng' => 'Defense'
            ],
            [
                'name' => 'อุตสาหกรรมการศึกษาและพัฒนาทักษะ (Education and Skill Development)',
                'nameth' => 'อุตสาหกรรมการศึกษาและพัฒนาทักษะ',
                'nameeng' => 'Education and Skill Development'
            ],
            [
                'name' => 'อื่นๆ',
                'nameth' => 'อื่นๆ',
                'nameeng' => 'Other'
            ],
        ]);
    }
}
