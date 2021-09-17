<?php

use Illuminate\Database\Seeder;

class PopupMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('popup_messages')->insert([
            [
            'category_id' =>1,
            'title' => 'ผิดพลาด',
            'message' => 'โปรดทำเครื่องหมาย <i class="icon-checkbox-checked"></i> เพื่อรับรองข้อมูล ก่อนดำเนินการ',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'โปรดทำเครื่องหมาย <i class="icon-checkbox-checked"></i> เพื่อรับรองข้อมูล ก่อนดำเนินการ'
            ],
            [
            'category_id' =>1,
            'title' => 'โปรดยืนยัน',
            'message' => 'ยืนยันการส่งแบบคำขอรับการประเมิน TTRS',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ยืนยันการส่งแบบคำขอรับการประเมิน TTRS'
            ],
            [
            'category_id' =>1,
            'title' => 'โปรดยืนยัน',
            'message' => 'ส่งแบบคำขอรับการประเมิน TTRS และเลือกไฟล์ PDF <br>ที่ลงลายมือชื่อเรียบร้อยแล้ว',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ส่งแบบคำขอรับการประเมิน TTRS และเลือกไฟล์ PDF <br>ที่ลงลายมือชื่อเรียบร้อยแล้ว'
            ],
            [
            'category_id' =>1,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการส่งคืน Mini TBP',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการส่งคืน Mini TBP'
            ],
            [
            'category_id' =>1,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการอนุมัติ Mini TBP',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการอนุมัติ Mini TBP'
            ],
            [
            'category_id' =>1,
            'title' => 'ข้อมูลแก้ไข',
            'message' => 'โปรดระบุรายละเอียด/รายการที่ท่านได้แก้ในเอกสาร Mini TBP',
            'title_default' => 'ข้อมูลแก้ไข',
            'message_default' => 'โปรดระบุรายละเอียด/รายการที่ท่านได้แก้ในเอกสาร Mini TBP'
            ],
            [
            'category_id' =>1,
            'title' => 'ผิดพลาด',
            'message' => 'กรุณาเลือกการใช้ลายมือชื่ออิเล็กทรอนิกส์',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'กรุณาเลือกการใช้ลายมือชื่ออิเล็กทรอนิกส์'
            ],
            [
            'category_id' =>1,
            'title' => 'ผิดพลาด',
            'message' => 'กรุณาเลือกธนาคาร',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'กรุณาเลือกธนาคาร'
            ],
            [
            'category_id' =>1,
            'title' => 'ผิดพลาด',
            'message' => 'ยังไม่ได้เลือกผู้ลงนามในแบบคำขอรับบริการประเมิน',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'ยังไม่ได้เลือกผู้ลงนามในแบบคำขอรับบริการประเมิน'
            ],
            [
            'category_id' =>1,
            'title' => 'ผิดพลาด',
            'message' => 'มีผู้ลงนามที่ยังไม่ได้เพิ่มลายมือชื่อ',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'มีผู้ลงนามที่ยังไม่ได้เพิ่มลายมือชื่อ'
            ],
            [
            'category_id' =>1,
            'title' => 'ส่งแบบคำขอฯ เรียบร้อยแล้ว',
            'message' => 'เจ้าหน้าที่ TTRS จะพิจารณาและแจ้งผลการดำเนินการให้ทราบทาง<br>อีเมลที่ท่านแจ้งไว้',
            'title_default' => 'ส่งแบบคำขอฯ เรียบร้อยแล้ว',
            'message_default' => 'เจ้าหน้าที่ TTRS จะพิจารณาและแจ้งผลการดำเนินการให้ทราบทาง<br>อีเมลที่ท่านแจ้งไว้'
            ],
            [
            'category_id' =>1,
            'title' => 'ผิดพลาด',
            'message' => 'กรุณาระบุรายละเอียดที่แก้ไขใน Mini TBP',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'กรุณาระบุรายละเอียดที่แก้ไขใน Mini TBP'
            ],
            [
            'category_id' =>1,
            'title' => 'สำเร็จ',
            'message' => 'ส่งแบบคำขอรับการประเมิน TTRS สำเร็จ',
            'title_default' => 'สำเร็จ',
            'message_default' => 'ส่งแบบคำขอรับการประเมิน TTRS สำเร็จ'
            ],
            [
            'category_id' =>1,
            'title' => 'ผิดพลาด',
            'message' => 'กรุณากรอกเป็นภาษาอังกฤษ',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'กรุณากรอกเป็นภาษาอังกฤษ'
            ],
            [
            'category_id' =>1,
            'title' => 'ผิดพลาด',
            'message' => 'กรุณากรอกเว็ปไซต์เป็นภาษาอังกฤษ',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'กรุณากรอกเว็ปไซต์เป็นภาษาอังกฤษ'
            ],
            [
            'category_id' =>1,
            'title' => 'ผิดพลาด',
            'message' => 'รูปแบบไฟล์ไม่ถูกต้อง',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'รูปแบบไฟล์ไม่ถูกต้อง'
            ],
            [
            'category_id' =>2,
            'title' => 'ผิดพลาด',
            'message' => 'ยังไม่ได้เลือกผู้ลงนามในแบบฟอร์มแผนธุรกิจเทคโนโลยี',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'ยังไม่ได้เลือกผู้ลงนามในแบบฟอร์มแผนธุรกิจเทคโนโลยี'
            ],
            [
            'category_id' =>2,
            'title' => 'ผิดพลาด',
            'message' => 'มีผู้ลงนามที่ยังไม่ได้เพิ่มลายมือชื่อ',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'มีผู้ลงนามที่ยังไม่ได้เพิ่มลายมือชื่อ'
            ],
            [
            'category_id' =>2,
            'title' => 'ผิดพลาด',
            'message' => 'กรุณาเลือกการใช้ลายมือชื่ออิเล็กทรอนิกส์',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'กรุณาเลือกการใช้ลายมือชื่ออิเล็กทรอนิกส์'
            ],
            [
            'category_id' =>2,
            'title' => 'ผิดพลาด',
            'message' => 'เลือกผู้ลงนามได้ไม่เกิน 6 คน',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'เลือกผู้ลงนามได้ไม่เกิน 6 คน'
            ],
            [
            'category_id' =>2,
            'title' => 'ผิดพลาด',
            'message' => 'โปรดทำเครื่องหมาย <i class="icon-checkbox-checked"></i> เพื่อรับรองข้อมูลก่อนดำเนินการ',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'โปรดทำเครื่องหมาย <i class="icon-checkbox-checked"></i> เพื่อรับรองข้อมูลก่อนดำเนินการ'
            ],
            [
            'category_id' =>2,
            'title' => 'โปรดยืนยัน',
            'message' => 'ส่งแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ส่งแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)'
            ],
            [
            'category_id' =>2,
            'title' => 'โปรดยืนยัน',
            'message' => 'ยืนยันส่งแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ยืนยันส่งแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)'
            ],
            [
            'category_id' =>2,
            'title' => 'อัปโหลดไฟล์',
            'message' => 'โปรดแนบไฟล์แบบฟอร์ม Full TBP ที่ลงลายมือชื่อ <br> และประทับตราแล้ว',
            'title_default' => 'อัปโหลดไฟล์',
            'message_default' => 'โปรดแนบไฟล์แบบฟอร์ม Full TBP ที่ลงลายมือชื่อ <br> และประทับตราแล้ว'
            ],
            [
            'category_id' =>2,
            'title' => 'สำเร็จ',
            'message' => 'ส่งแบบแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) สำเร็จ',
            'title_default' => 'สำเร็จ',
            'message_default' => 'ส่งแบบแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) สำเร็จ'
            ],
            [
            'category_id' =>2,
            'title' => 'ข้อมูลแก้ไข',
            'message' => 'โปรดระบุรายละเอียด/รายการที่ท่านได้แก้ในเอกสาร Full TBP',
            'title_default' => 'ข้อมูลแก้ไข',
            'message_default' => 'โปรดระบุรายละเอียด/รายการที่ท่านได้แก้ในเอกสาร Full TBP'
            ],
            [
            'category_id' =>2,
            'title' => 'ผิดพลาด',
            'message' => 'กรุณาระบุข้อมูลที่แก้ไขใน Full TBP',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'กรุณาระบุข้อมูลที่แก้ไขใน Full TBP'
            ],
            [
            'category_id' =>2,
            'title' => 'เสร็จสิ้น',
            'message' => 'ส่งแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) เรียบร้อยแล้ว <br> เจ้าหน้าที่ TTRS จะพิจารณาและแจ้งการดำเนินการในลำดับถัดไปให้ท่านทราบทางอีเมล',
            'title_default' => 'เสร็จสิ้น',
            'message_default' => 'ส่งแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) เรียบร้อยแล้ว <br> เจ้าหน้าที่ TTRS จะพิจารณาและแจ้งการดำเนินการในลำดับถัดไปให้ท่านทราบทางอีเมล'
            ],
            [
            'category_id' =>2,
            'title' => 'คำเตือน',
            'message' => 'การเปลี่ยนจำนวนเดือน รายละเอียดการดำเนินงาน<br>ของโครงการเดิมจะถูกลบ ยืนยันทำรายการ',
            'title_default' => 'คำเตือน',
            'message_default' => 'การเปลี่ยนจำนวนเดือน รายละเอียดการดำเนินงาน<br>ของโครงการเดิมจะถูกลบ ยืนยันทำรายการ'
            ],
            [
            'category_id' =>2,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการอนุมัติ Full TBP',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการอนุมัติ Full TBP'
            ],
            [
            'category_id' =>2,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการส่งคืน Full TBP ให้แก้ไข',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการส่งคืน Full TBP ให้แก้ไข'
            ],
            [
            'category_id' =>2,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการทำรายการลงคะแนน',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการทำรายการลงคะแนน'
            ],
            [
            'category_id' =>3,
            'title' => 'การมอบหมาย',
            'message' => 'ต้องการลบการเลือกผู้เชี่ยวชาญ',
            'title_default' => 'การมอบหมาย',
            'message_default' => 'ต้องการลบการเลือกผู้เชี่ยวชาญ'
            ],
            [
            'category_id' =>3,
            'title' => 'การมอบหมาย',
            'message' => 'ต้องการเพิ่มผู้เชี่ยวชาญ',
            'title_default' => 'การมอบหมาย',
            'message_default' => 'ต้องการเพิ่มผู้เชี่ยวชาญ'
            ],
            [
            'category_id' =>3,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการมอบหมายผู้เชี่ยวชาญ',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการมอบหมายผู้เชี่ยวชาญ'
            ],
            [
            'category_id' =>3,
            'title' => 'สำเร็จ',
            'message' => 'ส่งผู้เชี่ยวชาญให้ Manager พิจารณาสำเร็จ',
            'title_default' => 'สำเร็จ',
            'message_default' => 'ส่งผู้เชี่ยวชาญให้ Manager พิจารณาสำเร็จ'
            ],
            [
            'category_id' =>3,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการยืนยันทีมผู้เชี่ยวชาญ',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการยืนยันทีมผู้เชี่ยวชาญ'
            ],
            [
            'category_id' =>3,
            'title' => 'ผิดพลาด',
            'message' => 'ไม่พบข้อมูลผู้เชี่ยวชาญที่ตอบรับ',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'ไม่พบข้อมูลผู้เชี่ยวชาญที่ตอบรับ'
            ],
            [
            'category_id' =>3,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการส่งรายการมอบหมาย',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการส่งรายการมอบหมาย'
            ],
            [
            'category_id' =>4,
            'title' => 'ผิดพลาด',
            'message' => 'ยังไม่ได้เลือกรายการหรือรายการที่เลือกน้อยกว่าเกรด A',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'ยังไม่ได้เลือกรายการหรือรายการที่เลือกน้อยกว่าเกรด A'
            ],
            [
            'category_id' =>4,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการเพิ่ม เปอร์เซนต์ Extra',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการเพิ่ม เปอร์เซนต์ Extra'
            ],
            [
            'category_id' =>4,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการยกเลิก เปอร์เซนต์ Extra',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการยกเลิก เปอร์เซนต์ Extra'
            ],
            [
            'category_id' =>4,
            'title' => 'นำส่ง EV',
            'message' => 'ต้องการนำส่ง EV',
            'title_default' => 'นำส่ง EV',
            'message_default' => 'ต้องการนำส่ง EV'
            ],
            [
            'category_id' =>4,
            'title' => 'ผิดพลาด',
            'message' => 'กรุณากรอกข้อมูลให้ครบทุก Pillar',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'กรุณากรอกข้อมูลให้ครบทุก Pillar'
            ],
            [
            'category_id' =>4,
            'title' => 'ผิดพลาด',
            'message' => 'ยังไม่ได้เพิ่ม Criteria',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'ยังไม่ได้เพิ่ม Criteria'
            ],
            [
            'category_id' =>4,
            'title' => 'ผิดพลาด',
            'message' => 'ยังไม่ได้เพิ่ม Extra Criteria',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'ยังไม่ได้เพิ่ม Extra Criteria'
            ],
            [
            'category_id' =>4,
            'title' => 'สำเร็จ',
            'message' => 'นำส่ง EV สำเร็จ',
            'title_default' => 'สำเร็จ',
            'message_default' => 'นำส่ง EV สำเร็จ'
            ],
            [
            'category_id' =>4,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการอนุมัติ EV',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการอนุมัติ EV'
            ],
            [
            'category_id' =>4,
            'title' => 'สำเร็จ',
            'message' => 'Admin สามารถกำหนด Weight ในขั้นตอนถัดไป',
            'title_default' => 'สำเร็จ',
            'message_default' => 'Admin สามารถกำหนด Weight ในขั้นตอนถัดไป'
            ],
            [
            'category_id' =>4,
            'title' => 'ผิดพลาด',
            'message' => 'ยังไม่ได้กำหนดเปอร์เซนต์ Extra',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'ยังไม่ได้กำหนดเปอร์เซนต์ Extra'
            ],
            [
            'category_id' =>4,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการส่งคืนให้ Leader แก้ไข',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการส่งคืนให้ Leader แก้ไข'
            ],
            [
            'category_id' =>4,
            'title' => 'ผิดพลาด',
            'message' => 'เกรด A มีจำนวนมากกว่ารายการ Checklist',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'เกรด A มีจำนวนมากกว่ารายการ Checklist'
            ],
            [
            'category_id' =>4,
            'title' => 'ผิดพลาด',
            'message' => 'รายการ Criteria มีใน EV แล้ว',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'รายการ Criteria มีใน EV แล้ว'
            ],
            [
            'category_id' =>4,
            'title' => 'สำเร็จ',
            'message' => 'เพิ่มรายการสำเร็จ',
            'title_default' => 'สำเร็จ',
            'message_default' => 'เพิ่มรายการสำเร็จ'
            ],
            [
            'category_id' =>4,
            'title' => 'สำเร็จ',
            'message' => 'แก้ไข EV สำเร็จ',
            'title_default' => 'สำเร็จ',
            'message_default' => 'แก้ไข EV สำเร็จ'
            ],
            [
            'category_id' =>4,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการส่งคืนให้ Admin แก้ไข',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการส่งคืนให้ Admin แก้ไข'
            ],
            [
            'category_id' =>4,
            'title' => 'สำเร็จ',
            'message' => 'EV ได้รับการอนุมัติแล้ว',
            'title_default' => 'สำเร็จ',
            'message_default' => 'EV ได้รับการอนุมัติแล้ว'
            ],
            [
            'category_id' =>4,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการนำส่ง Manager',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการนำส่ง Manager'
            ],
            [
            'category_id' =>4,
            'title' => 'ผิดพลาด',
            'message' => 'กรอก Weight ไม่ครบ หรือกรอกค่า Weight เป็น 0',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'กรอก Weight ไม่ครบ หรือกรอกค่า Weight เป็น 0'
            ],
            [
            'category_id' =>4,
            'title' => 'ผิดพลาด',
            'message' => 'ผลรวม Extra Weight ไม่เท่ากับ 1',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'ผลรวม Extra Weight ไม่เท่ากับ 1'
            ],
            [
            'category_id' =>4,
            'title' => 'ผิดพลาด',
            'message' => 'ผลรวม Extra Weight ไม่เท่ากับ 1',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'ผลรวม Extra Weight ไม่เท่ากับ 1'
            ],
            [
            'category_id' =>4,
            'title' => 'สำเร็จ',
            'message' => 'นำส่ง Manager สำเร็จ',
            'title_default' => 'สำเร็จ',
            'message_default' => 'นำส่ง Manager สำเร็จ'
            ],
            [
            'category_id' =>5,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการยืนยันสร้างปฎิทิน',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการยืนยันสร้างปฎิทิน'
            ],
            [
            'category_id' =>5,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการเปลี่ยนเป็นให้เข้าร่วม',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการเปลี่ยนเป็นให้เข้าร่วม'
            ],
            [
            'category_id' =>6,
            'title' => 'สำเร็จ',
            'message' => 'เพิ่มไฟล์ BOL สำเร็จ',
            'title_default' => 'สำเร็จ',
            'message_default' => 'เพิ่มไฟล์ BOL สำเร็จ'
            ],
            [
            'category_id' =>7,
            'title' => 'ผิดพลาด',
            'message' => 'กรอกเกรด A-F เท่านั้น',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'กรอกเกรด A-F เท่านั้น'
            ],
            [
            'category_id' =>7,
            'title' => 'ผิดพลาด',
            'message' => 'กรอกคะแนน 0-5 เท่านั้น',
            'title_default' => 'ผิดพลาด',
            'message_default' => 'กรอกคะแนน 0-5 เท่านั้น'
            ],
            [
            'category_id' =>7,
            'title' => 'สำเร็จ',
            'message' => 'นำส่งคะแนนสำเร็จ',
            'title_default' => 'สำเร็จ',
            'message_default' => 'นำส่งคะแนนสำเร็จ'
            ],
            [
            'category_id' =>7,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการนำส่งคะแนน',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการนำส่งคะแนน'
            ],
            [
            'category_id' =>7,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการบันทึกผลสรุปคะแนน',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการบันทึกผลสรุปคะแนน'
            ],
            [
            'category_id' =>7,
            'title' => 'สำเร็จ',
            'message' => 'สรุปคะแนนสำเร็จ',
            'title_default' => 'สำเร็จ',
            'message_default' => 'สรุปคะแนนสำเร็จ'
            ],
            [
            'category_id' =>7,
            'title' => 'โปรดยืนยัน',
            'message' => 'การแจ้งผลจะแสดงเกรดและผลการประเมินให้ผู้ประกอบการทราบ ยืนยันแจ้งผลการประเมิน',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'การแจ้งผลจะแสดงเกรดและผลการประเมินให้ผู้ประกอบการทราบ ยืนยันแจ้งผลการประเมิน'
            ],
            [
            'category_id' =>7,
            'title' => 'โปรดยืนยัน',
            'message' => 'ยืนยันการส่งจดหมายแล้ว',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ยืนยันการส่งจดหมายแล้ว'
            ],
            [
            'category_id' =>7,
            'title' => 'โปรดยืนยัน',
            'message' => 'ต้องการสิ้นสุดโครงการ',
            'title_default' => 'โปรดยืนยัน',
            'message_default' => 'ต้องการสิ้นสุดโครงการ'
            ]
        ]);
    }
}
