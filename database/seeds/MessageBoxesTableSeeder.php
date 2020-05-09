<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MessageBoxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('message_boxes')->insert([
            [
                'title' => 'สอบถามข้อมูลครับ',
                'body' => 'บุคลากรวงในทำเนียบขาวติดเชื้อไวรัสโคโรนาสายพันธุ์ใหม่ สร้างความกังวลอย่างมาก ท่ามกลางความพยายามของทรัมป์ เดินหน้าเปิดกิจกรรมทางเศรษฐกิจ หลังจากที่นายโดนัลด์ ทรัมป์ ประธานาธิบดีสหรัฐฯ เดินทางออกจากทำเนียบขาวเพื่อลงพื้นที่เยี่ยมเยือนโรงงานผลิตหน้ากากอนามัยในมลรัฐแอริโซนา เมื่อวันที่ 5 พ.ค. พร้อมแสดงจุดยืนว่า ขณะนี้สหรัฐฯ พร้อมแล้วที่จะเปิดเมืองให้กิจกรรมต่างๆเ ริ่มกลับมาดำเนินการตามปกติอีกครั้ง สำนักข่าว CNN รายงานว่า บุคคลใกล้ชิดประธานาธิบดี ซึ่งเป็นทหารผู้ช่วยและสมาชิกระดับสูงของกองทัพสหรัฐฯ ติดเชื้อโคโรนาไวรัสสายพันธุ์ใหม่ (SARS-CoV-2) หรือโรคโควิด-19 ด้าน นายทรัมป์ ยืนยัน รู้จักชายคนนี้ดี แต่มีปฏิสัมพันธ์ต่อกันค่อนข้างน้อย และหลังจากที่ทราบข่าวก็มีการตรวจเชื้อแบบรายวัน ซึ่งชี้ว่าตอนนี้สถานะการติดเชื้อของผู้นำสหรัฐฯ ยังเป็นลบอยู่ อย่างไรก็ตาม 2 วันหลังจากที่พบการติดเชื้อของทหารผู้ช่วยผู้นำสหรัฐฯ ก็มีรายงานออกมาว่า เคที มิลเลอร์ เลขานุการฝ่ายสื่อของนายไมค์ เพนซ์ รองประธานาธิบดีสหรัฐฯ ติดโรคโควิด-19 เช่นกัน',
                'message_priority_id' => 1,
                'sender_id' => 9,
                'created_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString(),
                'updated_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString()

            ],
            [
                'title' => 'สอบถามข้อมูลค่ะ',
                'body' => 'สอบถามข้อมูลค่ะ....',
                'message_priority_id' => 1,
                'sender_id' => 10,
                'created_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString(),
                'updated_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString()
            ],
            [
                'title' => 'สอบถามสถานะ',
                'body' => 'สอบถามสถานะ....',
                'message_priority_id' => 1,
                'sender_id' => 11,
                'created_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString(),
                'updated_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString()
            ]
        ]);
    }
}
