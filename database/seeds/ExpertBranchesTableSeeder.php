<?php

use Illuminate\Database\Seeder;

class ExpertBranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expert_branches')->insert([
            [
                'name' => 'เทคโนโลยีการเกษตร'
            ],
            [
                'name' => 'เทคโนโลยีอาหาร'
            ],
            [
                'name' => 'เทคโนโลยีชีวภาพ'
            ],
            [
                'name' => 'เทคโนโลยีสิ่งทอและเครื่องหนัง'
            ],
            [
                'name' => 'เทคโนโลยีอัญมณีและเครื่องประดับ'
            ],
            [
                'name' => 'เทคโนโลยีโลหะและวัสดุ'
            ],
            [
                'name' => 'เทคโนโลยีทางการแพทย์ ยา เวชภัณฑ์ และเครื่องสำอาง'
            ],
            [
                'name' => 'เทคโนโลยีสารสนเทศและการสื่อสาร'
            ],
            [
                'name' => 'เทคโนโลยียานยนต์และชิ้นส่วน'
            ],
            [
                'name' => 'เทคโนโลยีวิศวกรรมเครื่องกล'
            ],
            [
                'name' => 'เทคโนโลยีการพิมพ์และบรรจุภัณฑ์'
            ],
            [
                'name' => 'เทคโนโลยีปิโตรเคมีและเคมีภัณฑ์'
            ],
            [
                'name' => 'เทคโนโลยีพลังงานและสิ่งแวดล้อม'
            ],
            [
                'name' => 'เทคโนโลยีมัลติมิเดีย'
            ],
            [
                'name' => 'เทคโนโลยีอิเล็กทรอนิกส์ คอมพิวเตอร์ และไฟฟ้า'
            ],
            [
                'name' => 'การจัดการ/บริหารธุรกิจ'
            ],
            [
                'name' => 'การตลาด'
            ],
            [
                'name' => 'บัญชี/การเงิน'
            ],
            [
                'name' => 'อื่นๆ'
            ]
        ]);
    }
}