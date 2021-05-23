<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class GeneralInfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('general_infos')->insert([
            [
                'company' => 'สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)',
                'phone1' => '0-2564-7000',
                'phone2' => '0-2564-8000',
                'fax' => '0-2564-7001-5',
                'email' => 'ttrs@nstda.or.th',
                'youtube' => 'https://youtube.com',
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com',
                'instagram' => 'https://www.instagram.com',
                'skype' => 'https://www.skype.com',
                'linkedin' => 'https://th.linkedin.com',
                'workdaytime' => '08.00-16.00',
                'saturdaytime' => 'ปิดทำการ',
                'sundaytime' => 'ปิดทำการ',
                'address' => '111 อุทยานวิทยาศาสตร์ประเทศไทย ถ.พหลโยธิน',
                'client_id' => 'j7GPSrVYdCTx8DYFR7hj1g',
                'client_secret' => 'OQp6hut4pyeLxWnUa1STegdZ1b4QqGtgK6AIN4V8qn0',
                'thsmsuser' => 'program6944',
                'thsmspass' => Crypt::encrypt('dd9039'),
                'verify_type_id' => 1,
                'front_page_status_id' => 1,
                'layout_style_id' => 2,
                'director' => 'นายณรงค์ ศิริเลิศวรกุล',
                'logo' => 'assets/landing2/images/logo-dark2021.png',
                'logo2' => 'assets/landing2/images/logo2021.png',
                'consent' => '1. วัตถุประสงค์
                ศูนย์สนับสนุนและให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศ (Thailand Technology Rating Support and Service Center; TTRS) สํานักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.) เป็นหน่วยงานที่มีพันธกิจหลักในการสนับสนุนและให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศ เพื่อส่งเสริมและสนับสนุนผู้ประกอบการ SMEs ที่มีเทคโนโลยีและนวัตกรรม ให้สามารถเข้าถึงแหล่งเงินทุนเพื่อใช้ในการดําเนินธุรกิจ ปัจจุบันสวทช. ได้พัฒนาองค์ความรู้ที่ได้รับการถ่ายทอดจาก Korea Technology Finance Corporation (KOTEC) โดยบูรณาการร่วมกับองค์ความรู้และประสบการณ์ของผู้เชี่ยวชาญทางด้านเทคโนโลยีและนวัตกรรมในสาขาต่างๆของ สวทช. ผู้เชี่ยวชาญด้านธุรกิจ การเงิน และการจัดการ รวมถึงศึกษาแนวทางและกลไกอื่นๆ จนได้ระบบการประเมินจัดอันดับเทคโนโลยีที่สอดคล้องกับระบบนิเวศน์และบริบทของประเทศไทย เพื่อให้การดําเนินงานสนับสนุนและให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศสัมฤทธิ์ผล ศูนย์ TTRS จําเป็นต้องมีระบบเทคโนโลยีสารสนเทศและการสือสารที่มีประสิทธิภาพรองรับการดําเนินงานตามภารกิจ ตอบสนองความต้องการใช้ข้อมูลในการ ดําเนินงาน จึงได้จัดทําโครงการพัฒนาระบบสารสนเทศเพื่อเพิ่มประสิทธิภาพการดําเนินงานและให้บริการขึ้น การใช้ระบบฐานข้อมูลและจัดทำเว็บไซต์ให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศของผู้ใช้บริการจะอยู่ภายใต้เงื่อนไขและข้อกำหนดดังต่อไปนี้ ผู้ใช้บริการจึงควรศึกษาเงื่อนไขและข้อกำหนดการใช้งานเว็บไซต์ และ/หรือเงื่อนไขและข้อตกลงอื่นใดที่สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติได้แจ้งให้ทราบบนเว็บไซต์โดยละเอียดก่อนการเข้าใช้บริการ ทั้งนี้ ในการใช้บริการให้ถือว่าผู้ใช้บริการได้ตกลงที่จะปฏิบัติตาม เงื่อนไขและข้อกำหนดการให้บริการที่กำหนดไว้นี้ หากผู้ใช้บริการไม่ประสงค์ที่จะผูกพันตามข้อกำหนดและเงื่อนไขการให้บริการ ขอความกรุณาท่านยุติการเข้าชมและใช้งานเว็บไซต์นี้ในทันที
                <br><br>2. เงื่อนไขและข้อกำหนดการใช้งานระบบฐานข้อมูลและจัดทำเว็บไซต์ให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศ
                <br>2.1 ผู้ใช้บริการอาจได้รับ เข้าถึง สร้าง ส่งหรือแสดงข้อมูล เช่น ไฟล์ข้อมูล ข้อความลายลักษณ์ อักษร ซอฟต์แวร์คอมพิวเตอร์ ดนตรี ไฟล์เสียง หรือเสียงอื่นๆ ภาพถ่าย วิดีโอ หรือรูปภาพ อื่นๆ โดยเป็นส่วนหนึ่งของบริการหรือโดยผ่านการใช้บริการ ซึ่งต่อไปนี้จะเรียกว่า “เนื้อหา”
                <br>2.2 เนื้อหาที่นำเสนอต่อผู้ใช้บริการ อาจได้รับการคุ้มครองโดยสิทธิในทรัพย์สินทางปัญญาของ เจ้าของเนื้อหานั้น ผู้ใช้บริการไม่มีสิทธิเปลี่ยนแปลงแก้ไข จำหน่ายจ่ายโอนหรือสร้างผลงานต่อเนื่องโดยอาศัยเนื้อหาดังกล่าวไม่ว่าจะทั้งหมดหรือบางส่วน เว้นแต่ผู้ใช้บริการจะได้รับอนุญาตโดยชัดแจ้งจากเจ้าของเนื้อหานั้น
                <br>2.3 ผู้ใช้บริการอาจพบเนื้อหาที่ไม่เหมาะสม หรือหยาบคาย อันก่อให้เกิดความไม่พอใจ ภายใต้ความเสี่ยงของตนเอง
                <br>2.4 สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติทรงไว้ซึ่งสิทธิในการคัดกรอง ตรวจทาน ทำเครื่องหมาย การปฏิเสธความรับผิดมาย เปลี่ยนแปลง แก้ไข ปฏิเสธ หรือลบเนื้อหาใดๆ ที่ไม่เหมาะสมออกจากบริการ ซึ่งสำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ อาจจัดเตรียมเครื่องมือในการคัดกรองเนื้อหาอย่างชัดเจน โดยไม่ขัดต่อกฎหมาย กฎ ระเบียบของทางราชการที่เกี่ยวข้อง
                <br>2.5 สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติอาจหยุดให้บริการระบบฐานข้อมูลและจัดทำเว็บไซต์ให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศเป็นการชั่วคราวหรือถาวร หรือยกเลิกการให้บริการ แก่ผู้ใช้บริการรายใดเป็นการเฉพาะ หากการให้บริการดังกล่าวส่งผลกระทบต่อผู้ใช้บริการ อื่นๆ หรือขัดแย้งต่อกฎหมาย โดยไม่ต้องแจ้งให้ผู้ใช้บริการทราบล่วงหน้า
                <br>2.6 การหยุดหรือการยกเลิกบริการตามข้อ 2.5 ผู้ใช้บริการจะไม่สามารถเข้าใช้บริการ และ เข้าถึงรายละเอียดบัญชีของผู้ใช้บริการ ไฟล์เอกสารใดๆ หรือเนื้อหาอื่นๆที่อยู่ในบัญชีของ ผู้ใช้บริการได้
                <br>2.7 ในกรณีสำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ หยุดให้บริการระบบฐานข้อมูลและจัดทำเว็บไซต์ให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศเป็นการถาวร หรือยกเลิกบริการแก่ ผู้ใช้บริการ ระบบฐานข้อมูลและจัดทำเว็บไซต์ให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศ ที่อยู่ในบัญชีของผู้ใช้บริการได้ โดยไม่ต้องแจ้งให้ผู้ใช้บริการทราบล่วงหน้า
                <br><br>3. สิทธิ หน้าที่ และความรับผิดชอบของผู้ใช้บริการ
                <br>3.1 ผู้ใช้บริการจะให้ข้อมูลเกี่ยวกับตนเอง เช่น ข้อมูลระบุตัวตนหรือรายละเอียดการติดต่อ ที่ถูกต้อง เป็นจริง และเป็นปัจจุบันเสมอ สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ อันเป็นส่วนหนึ่งของ กระบวนการลงทะเบียนใช้บริการ หรือการใช้บริการที่ต่อเนื่อง
                <br>3.2 ผู้ใช้บริการจะใช้บริการระบบฐานข้อมูลและจัดทำเว็บไซต์ให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศนี้ เพื่อวัตถุประสงค์ที่ได้รับอนุญาตตามข้อกำหนดของ สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติและไม่ขัดต่อกฎหมาย กฎ ระเบียบข้อบังคับ หลักปฏิบัติที่เป็นที่ ยอมรับโดยทั่วไป
                <br>3.3 ผู้ใช้บริการจะไม่เข้าใช้หรือพยายามเข้าใช้บริการหนึ่งบริการใดโดยวิธีอื่น รวมถึงการใช้ วิธีการอัตโนมัติ (การใช้สคริปต์) นอกจากช่องทางที่ สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ จัดเตรียมไว้ให้ เว้นแต่ผู้ใช้บริการจะได้รับอนุญาตจากสำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ โดยชัดแจ้งให้ทำเช่นนั้นได้
                <br>3.4 ผู้ใช้บริการจะไม่ทำหรือมีส่วนร่วมในการขัดขวางหรือรบกวน ระบบฐานข้อมูลและจัดทำเว็บไซต์ให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศ รวมทั้งเครื่องแม่ข่ายและเครือข่ายที่เชื่อมต่อกับบริการ
                <br>3.5 ผู้ใช้บริการจะไม่ทำสำเนา คัดลอก ทำซ้ำ ขาย แลกเปลี่ยน หรือขายต่อบริการเพื่อวัตถุประสงค์ใดๆ เว้นแต่ผู้ใช้บริการจะได้รับอนุญาตจากสำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติโดยชัดแจ้งให้ทำเช่นนั้นได้
                <br>3.6 ผู้ใช้บริการมีหน้าที่ในการรักษาความลับของรหัสผ่านที่เชื่อมโยงกับบัญชีใดๆ ที่ใช้ในการเข้าถึงบริการ
                <br>3.7 ผู้ใช้บริการจะเป็นผู้รับผิดชอบแต่เพียงผู้เดียวต่อบุคคลใดๆ รวมถึง สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติในความเสียหายอันเกิดจากการละเมิดข้อกำหนด
                <br><br>4. การเชื่อมโยงกับเว็บไซต์อื่นๆ
                <br>4.1 การเชื่อมโยงไปยังเว็บไซต์อื่นเป็นเพียงการให้บริการเพื่ออำนวยความสะดวกแก่ผู้ใช้บริการเท่านั้น สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ มิได้มีส่วนเกี่ยวข้องหรือมีอำนาจควบคุม รับรอง ความถูกต้อง ความน่าเชื่อถือ ตลอดจนความรับผิดชอบในเนื้อหาข้อมูลของเว็บไซต์นั้นๆ และสำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติไม่รับผิดชอบต่อเนื้อหาใดๆ ที่แสดงบนเว็บไซต์อื่นที่เชื่อมโยงมายังเว็บไซต์ให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศหรือต่อความเสียหายใดๆ ที่เกิดขึ้นจากการเข้าเยี่ยมชมเว็บไซต์ดังกล่าว
                <br>4.2 กรณีต้องการเชื่อมโยงมายังเว็บไซต์ให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศผู้ใช้บริการสามารถเชื่อมโยงมายังหน้าแรกของเว็บไซต์ให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศได้ โดยแจ้งความประสงค์เป็นหนังสือ แต่หากต้องการเชื่อมโยงมายังหน้าภายในของเว็บไซต์นี้ จะต้องได้รับความยินยอมเป็น หนังสือจากสำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติแล้วเท่านั้น และในการให้ความยินยอมดังกล่าว สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ ขอสงวนสิทธิที่จะกำหนดเงื่อนไขใดๆ ไว้ด้วยก็ได้ ในการที่เว็บไซต์อื่น ที่เชื่อมโยงมายังเว็บไซต์ให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศจะไม่รับผิดชอบต่อเนื้อหาใดๆ ที่แสดงบนเว็บไซต์ที่เชื่อมโยงมายังเว็บไซต์ให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศหรือต่อความเสียหายใดๆ ที่เกิดขึ้นจากการใช้เว็บไซต์เหล่านั้น
                <br><br>5. การปฏิเสธความรับผิด
                สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติจะไม่รับผิดต่อความเสียหายใดๆ รวมถึง ความเสียหาย สูญเสียและค่าใช้จ่ายที่เกิดขึ้นไม่ว่าโดยตรงหรือโดยอ้อม ที่เป็นผลหรือสืบเนื่องจากการที่ผู้ใช้เข้าใช้เว็บไซต์นี้หรือเว็บไซต์ที่เชื่อมโยงกับเว็บไซต์นี้ หรือต่อความเสียหาย สูญเสียหรือค่าใช้จ่ายที่ เกิดจากความล้มเหลวในการใช้งาน ความผิดพลาด การละเว้น การหยุดชะงัก ข้อบกพร่อง ความไม่สมบูรณ์ คอมพิวเตอร์ไวรัส ถึงแม้ว่า สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ จะได้รับแจ้งว่าอาจจะเกิดความเสียหาย สูญเสียหรือค่าใช้จ่ายดังกล่าวขึ้น นอกจากนี้ สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ ไม่รับผิดต่อผู้ใช้เว็บไซต์หรือบุคคลจากการเรียกร้องใดๆ ที่เกิดขึ้นจากบนเว็บไซต์ หรือเนื้อหาใดๆ ซึ่งรวมถึงการตัดสินใจหรือการกระทำใดๆ ที่เกิดจากความเชื่อถือในเนื้อหาดังกล่าวของ ผู้ใช้เว็บไซต์ หรือในความเสียหายใดๆ ไม่ว่าความเสียหายทางตรง หรือทางอ้อม รวมถึงความเสียหายอื่นใดที่อาจเกิดขึ้นได้ผู้ใช้บริการยอมรับและตระหนักดีว่า สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติจะไม่ต้องรับผิดชอบต่อการกระทำใดของผู้ใช้บริการทั้งสิ้น
                <br><br>6. กรรมสิทธิ์และสิทธิในทรัพย์สินทางปัญญา
                <br>6.1 สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ หรือผู้ให้อนุญาตแก่สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ เป็นผู้มีสิทธิตามกฎหมายแต่ เพียงผู้เดียวใน กรรมสิทธิ์ ผลประโยชน์ทั้งหมด รวมถึงสิทธิในทรัพย์สินทางปัญญาใดๆ ที่มี อยู่ในบริการซึ่ง สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ หรือผู้ให้อนุญาตแก่สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติเป็นผู้จัดทำขึ้น ไม่ว่าสิทธิเหล่านั้นจะได้รับการจดทะเบียนไว้หรือไม่ก็ตาม
                <br>6.2 ผู้ใช้บริการจะต้องไม่เปิดเผยข้อมูลที่สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ กำหนดให้เป็นความลับ โดยไม่ได้รับความยินยอมเป็นลายลักษณ์อักษรล่วงหน้าจาก สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ 
                <br>6.3 ผู้ใช้บริการจะต้องไม่ใช้ชื่อทางการค้า เครื่องหมายการค้า เครื่องหมายการบริการ ตราสัญลักษณ์ ชื่อโดเมนของ สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ โดยไม่ได้รับความยินยอมเป็นลายลักษณ์อักษรจากสำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ
                <br><br>7. กฎหมายที่ใช้บังคับ
                การตีความ และการบังคับตามเงื่อนไขการให้บริการฉบับนี้ ให้เป็นไปตามกฎหมายไทย'
            ],
        ]);
    }
}
