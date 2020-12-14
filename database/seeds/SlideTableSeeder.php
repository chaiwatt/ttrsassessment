<?php

use Illuminate\Database\Seeder;

class SlideTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slides')->insert([
            [
                // 'slide_status_id' => 1,
                // 'slide_style_id' => 1,
                // 'textone' => 'ประเมินเทคโนโลยีโดยใช้โมเดล TTRS',
                // 'textengone' => 'TTRS (Thailand Technology Rating System)',
                // 'texttwo' => 'สำหรับการประเมินเทคโนโลยีของผู้ประกอบการ SMEs พัฒนา โดยความร่วมมือระหว่างสำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)',
                // 'textengtwo' => 'TTRS, evaluation tool through which the commercial viability and risks associated for SMEs.',
                // 'textthree' => 'เพิ่มเติม',
                // 'textengthree' => 'Read More',
                'name' => 'slide1.png',
                'file' => '/assets/landing/img/slides/slide1.png',
            ],
            [
                // 'slide_status_id' => 1,
                // 'slide_style_id' => 2,
                // 'textone' => 'ฟรีค่าธรรมเนียมการประเมิน',
                // 'textengone' => 'Appy now for free evaluation fee.',
                // 'texttwo' => 'ด่วนจำนวนจำกัด สอบถามเพิ่มเติมได้ที่ 02-564-7000 ต่อ 71752',
                // 'textengtwo' => 'Need more information, call 02-564-7000 ext 71752.',
                // 'textthree' => 'เพิ่มเติม',
                // 'textengthree' => 'Read More',
                'name' => 'slide2.png',
                'file' => '/assets/landing/img/slides/slide2.png',
            ]
        ]);
    }
}

