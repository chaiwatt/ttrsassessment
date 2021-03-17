<?php

use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faqs')->insert([
            [
                'title' => 'โปรดิวเซอร์โฮปทำงานอาว์ ',
                'body' => 'ฟอยล์โปลิศเพนกวิน อุปทานโปรดิวเซอร์ เฉิ่ม เตี๊ยม ฟยอร์ดโมจิมอบตัวซูชิ วัคค์ทอร์นาโดสัมนารัม สตูดิโอถ่ายทำภควัมบดีอ่วมโมหจริต คูลเลอร์มั้ยบาบูนง่าว สถาปัตย์รีวิวเวเฟอร์โอวัลตินเดี้ยง โปรดิวเซอร์เซ็กซ์อาร์พีจี มอยส์เจอไรเซอร์แคมป์บาบูนออสซี่เดี้ยง เนอะแหววต้าอ่วยฟรังก์ราเมน จิ๊กซอว์ สจ๊วตเดบิตจอหงวนเปปเปอร์มินต์ ล็อตรีสอร์ท',
                'titleeng' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                'bodyeng' => 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat',
            ],
            [
                'title' => 'ออทิสติกมาร์เก็ตแฟรนไชส์ ไฟลต์อ่อนด้อยคอมเมนท์',
                'body' => 'อินเตอร์คลาสสิกบัตเตอร์โบว์ ก่อนหน้า วอลนัท คาแรคเตอร์เซ่นไหว้รันเวย์เกรดแครอท เพรสสตีลรีโมตเยอบีรา แทคติคจึ๊กอีสเตอร์สโตร์ คีตราชันซิ่ง บอกซ์ แอสเตอร์จิ๊กหลวงปู่สเตชั่นนาฏยศาลา พูลอันเดอร์แอ๊บแบ๊วออยล์ เกสต์เฮาส์บึ้ม กฤษณ์ซูชิซื่อบื้อ ซันตาคลอสโชห่วยบูติคแรลลี่',
                'titleeng' => 'At vero eos et accusamus et iusto odio dignissimos ducimus',
                'bodyeng' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings',
            ],
            [
                'title' => 'อพาร์ตเมนท์อาร์พีจีสถาปัตย์ธัมโม ลอจิสติกส์ คอนโทรลกิฟท์อพาร์ตเมนต์',
                'body' => 'เกรย์ดัมพ์ ซีเนียร์ แฟรีสปิริต เอฟเฟ็กต์ซากุระซังเตมอคคาติ๋ม เอาต์รุมบ้า ปาร์ตี้สวีทแอลมอนด์ฮิบรู ถ่ายทำยูวีไวอากร้าเบอร์รีอวอร์ด เทคโนแครต ซิตี ชัตเตอร์ถ่ายทำวาทกรรมโมเดล คาปูชิโน แซ็กบอกซ์ ออเดอร์รันเวย์ราเมนพริตตี้',
                'titleeng' => 'At vero eos et accusamus et iusto odio dignissimos ducimus',
                'bodyeng' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings',
            ]
        ]);
    }
}
