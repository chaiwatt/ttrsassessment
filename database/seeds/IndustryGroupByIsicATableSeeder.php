<?php

use Illuminate\Database\Seeder;

class IndustryGroupByIsicATableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('industry_group_by_isic_a_s')->insert([
            [
                'industry_group_by_isic_id' => 1,
                'name' => 'การเพาะปลูกและการเลี้ยงสัตว์ การล่าสัตว์ และกิจกรรมบริการที่เกี่ยวข้อง',
                'code' => 'A010000',
            ],
            [
                'industry_group_by_isic_id' => 1,
                'name' => 'การป่าไม้และการทำไม้',
                'code' => 'A020000',
            ],
            [
                'industry_group_by_isic_id' => 1,
                'name' => 'การประมงและการเพาะเลี้ยงสัตว์น้ำ',
                'code' => 'A030000',
            ],
            [
                'industry_group_by_isic_id' => 2,
                'name' => 'การทำเหมืองถ่านหินและลิกไนต์',
                'code' => 'B050000',
            ],
            [
                'industry_group_by_isic_id' => 2,
                'name' => 'การขุดเจาะปิโตรเลียมดิบและก๊าซธรรมชาติ',
                'code' => 'B060000',
            ],
            [
                'industry_group_by_isic_id' => 2,
                'name' => 'การทำเหมืองสินแร่โลหะ',
                'code' => 'B070000',
            ],
            [
                'industry_group_by_isic_id' => 2,
                'name' => 'การทำเหมืองแร่และเหมืองหินอื่น ๆ',
                'code' => 'B080000',
            ],
            [
                'industry_group_by_isic_id' => 2,
                'name' => 'กิจกรรมบริการที่สนับสนุนการทำเหมืองแร่',
                'code' => 'B090000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตผลิตภัณฑ์อาหาร',
                'code' => 'C100000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตเครื่องดื่ม',
                'code' => 'C110000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตผลิตภัณฑ์ยาสูบ',
                'code' => 'C120000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตสิ่งทอ',
                'code' => 'C130000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตเสื้อผ้าเครื่องแต่งกาย',
                'code' => 'C140000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตเครื่องหนังและผลิตภัณฑ์ที่เกี่ยวข้อง',
                'code' => 'C150000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตไม้และผลิตภัณฑ์จากไม้และไม้ก๊อก (ยกเว้นเฟอร์นิเจอร์) การผลิตสิ่งของจากฟางและวัสดุถักสานอื่น ๆ',
                'code' => 'C160000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตกระดาษและผลิตภัณฑ์กระดาษ',
                'code' => 'C170000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การพิมพ์และการผลิตซ้ำสื่อบันทึกข้อมูล',
                'code' => 'C180000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตถ่านโค้กและผลิตภัณฑ์จากการกลั่นปิโตรเลียม',
                'code' => 'C190000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตเคมีภัณฑ์และผลิตภัณฑ์เคมี',
                'code' => 'C200000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตเภสัชภัณฑ์ เคมีภัณฑ์ที่ใช้รักษาโรค และผลิตภัณฑ์จากพืชและสัตว์ที่ใช้รักษาโรค',
                'code' => 'C210000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตผลิตภัณฑ์ยางและพลาสติก',
                'code' => 'C220000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตผลิตภัณฑ์อื่นๆ ที่ทำจากแร่อโลหะ',
                'code' => 'C230000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตโลหะขั้นมูลฐาน',
                'code' => 'C240000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตผลิตภัณฑ์ที่ทำจากโลหะประดิษฐ์ (ยกเว้นเครื่องจักรและอุปกรณ์)',
                'code' => 'C250000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตผลิตภัณฑ์คอมพิวเตอร์ อิเล็กทรอนิกส์ และอุปกรณ์ที่ใช้ในทางทัศนศาสตร์',
                'code' => 'C260000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตอุปกรณ์ไฟฟ้า',
                'code' => 'C270000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตเครื่องจักรและเครื่องมือ ซึ่งมิได้จัดประเภทไว้ในที่อื่น',
                'code' => 'C280000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตยานยนต์ รถพ่วง และรถกึ่งพ่วง',
                'code' => 'C290000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตอุปกรณ์ขนส่งอื่นๆ',
                'code' => 'C300000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตเฟอร์นิเจอร์',
                'code' => 'C310000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การผลิตผลิตภัณฑ์ประเภทอื่นๆ',
                'code' => 'C320000',
            ],
            [
                'industry_group_by_isic_id' => 3,
                'name' => 'การซ่อมและการติดตั้งเครื่องจักรและอุปกรณ์',
                'code' => 'C330000',
            ]

        ]);
    }
}
