<?php

use Illuminate\Database\Seeder;

class ReportListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('report_lists')->insert([
            [
                'order' => 1,
                'reporttype' => 1,
                'reportname' => 'โครงการที่ยื่น Mini TBP รายเดือน',
                'reportroute' => 'dashboard.admin.realtimereport.project.minitbpbymonth',
                'icon' => 'icon-file-text2',
                'group_id' => 5,
                'groupname' => 'MiniTBP'
            ],
            [
                'order' => 2,
                'reporttype' => 1,
                'reportname' => 'โครงการที่ยื่น Full TBP รายเดือน',
                'reportroute' => 'dashboard.admin.realtimereport.project.fulltbpbymonth',
                'icon' => 'icon-file-text2',
                'group_id' => 6,
                'groupname' => 'FullTBP'
            ],
            [
                'order' => 3,
                'reporttype' => 1,
                'reportname' => 'โครงการที่ประเมินแล้วเสร็จรายเดือน',
                'reportroute' => 'dashboard.admin.realtimereport.project.finishedbymonth',
                'icon' => 'icon-file-text2',
                'group_id' => 4,
                'groupname' => 'โครงการ (ที่ประเมินแล้วเสร็จ)'
            ],
            [
                'order' => 4,
                'reporttype' => 1,
                'reportname' => 'โครงการที่ขอยกเลิกรายเดือน',
                'reportroute' => 'dashboard.admin.realtimereport.project.canceledbymonth',
                'icon' => 'icon-file-text2',
                'group_id' => 10,
                'groupname' => 'โครงการ (ที่ขอยกเลิก)'
            ],
            [
                'order' => 5,
                'reporttype' => 1,
                'reportname' => 'โครงการที่ยื่น Mini TBP รายปี',
                'reportroute' => 'dashboard.admin.realtimereport.project.minitbpbyyear',
                'icon' => 'icon-file-text2',
                'group_id' => 5,
                'groupname' => 'MiniTBP'
            ],
            [
                'order' => 6,
                'reporttype' => 1,
                'reportname' => 'โครงการที่ยื่น Full TBP รายปี',
                'reportroute' => 'dashboard.admin.realtimereport.project.fulltbpbyyear',
                'icon' => 'icon-file-text2',
                'group_id' => 6,
                'groupname' => 'FullTBP'
            ],
            [
                'order' => 7,
                'reporttype' => 1,
                'reportname' => 'โครงการที่ประเมินแล้วเสร็จรายปี',
                'reportroute' => 'dashboard.admin.realtimereport.project.finishedbyyear',
                'icon' => 'icon-file-text2',
                'group_id' => 4,
                'groupname' => 'โครงการ (ที่ประเมินแล้วเสร็จ)'
            ],
            [
                'order' => 8,
                'reporttype' => 1,
                'reportname' => 'โครงการที่ขอยกเลิกรายปี',
                'reportroute' => 'dashboard.admin.realtimereport.project.canceledbyyear',
                'icon' => 'icon-file-text2',
                'group_id' => 10,
                'groupname' => 'โครงการ (ที่ขอยกเลิก)'
            ],
            [
                'order' => 9,
                'reporttype' => 1,
                'reportname' => 'โครงการที่ยื่น Mini TBP รายปีงบประมาณ',
                'reportroute' => 'dashboard.admin.realtimereport.project.minitbpbyyearbudget',
                'icon' => 'icon-file-text2',
                'group_id' => 5,
                'groupname' => 'MiniTBP'
            ],
            [
                'order' => 10,
                'reporttype' => 1,
                'reportname' => 'โครงการที่ยื่น Full TBP รายปีงบประมาณ',
                'reportroute' => 'dashboard.admin.realtimereport.project.fulltbpbyyearbudget',
                'icon' => 'icon-file-text2',
                'group_id' => 6,
                'groupname' => 'FullTBP'
            ],
            [
                'order' => 11,
                'reporttype' => 1,
                'reportname' => 'โครงการที่ประเมินแล้วเสร็จรายปีงบประมาณ',
                'reportroute' => 'dashboard.admin.realtimereport.project.finishedbyyearbudget',
                'icon' => 'icon-file-text2',
                'group_id' => 4,
                'groupname' => 'โครงการ (ที่ประเมินแล้วเสร็จ)'
            ],
            [
                'order' => 12,
                'reporttype' => 1,
                'reportname' => 'โครงการที่ขอยกเลิกรายปีงบประมาณ',
                'reportroute' => 'dashboard.admin.realtimereport.project.canceledbyyearbudget',
                'icon' => 'icon-file-text2',
                'group_id' => 10,
                'groupname' => 'โครงการ (ที่ขอยกเลิก)'
            ],
            [
                'order' => 13,
                'reporttype' => 1,
                'reportname' => 'โครงการทั้งหมดแยกตามปี',
                'reportroute' => 'dashboard.admin.realtimereport.project.allbyyear',
                'icon' => 'icon-file-text2',
                'group_id' => 1,
                'groupname' => 'โครงการ (ภาพรวม)'
            ],
            [
                'order' => 14,
                'reporttype' => 1,
                'reportname' => 'โครงการทั้งหมดแยกตามปีงบประมาณ',
                'reportroute' => 'dashboard.admin.realtimereport.project.allbyyearbudget',
                'icon' => 'icon-file-text2',
                'group_id' => 1,
                'groupname' => 'โครงการ (ภาพรวม)'
            ],
            [
                'order' => 15,
                'reporttype' => 1,
                'reportname' => 'โครงการแยกตามงบประมาณของโครงการ',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbycapital',
                'icon' => 'icon-file-text2',
                'group_id' => 1,
                'groupname' => 'โครงการ (ภาพรวม)'
            ],
            [
                'order' => 16,
                'reporttype' => 1,
                'reportname' => 'โครงการแยกตามประเภทธุรกิจ',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbybusinesstype',
                'icon' => 'icon-file-text2',
                'group_id' => 2,
                'groupname' => 'โครงการ (แยกตามธุรกิจและอุตสาหกรรม)'
            ],
            [
                'order' => 17,
                'reporttype' => 1,
                'reportname' => 'โครงการแยกตามขนาดธุรกิจ',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbybusinesssize',
                'icon' => 'icon-file-text2',
                'group_id' => 2,
                'groupname' => 'โครงการ (แยกตามธุรกิจและอุตสาหกรรม)'
            ],
            [
                'order' => 18,
                'reporttype' => 1,
                'reportname' => 'โครงการแยกตาม ISIC Code',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbyisiccode',
                'icon' => 'icon-file-text2',
                'group_id' => 2,
                'groupname' => 'โครงการ (แยกตามธุรกิจและอุตสาหกรรม)'
            ],
            [
                'order' => 19,
                'reporttype' => 1,
                'reportname' => 'โครงการแยกตามประเภทอุตสาหกรรม',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbyindustrygroup',
                'icon' => 'icon-file-text2',
                'group_id' => 2,
                'groupname' => 'โครงการ (แยกตามธุรกิจและอุตสาหกรรม)'
            ],
            [
                'order' => 20,
                'reporttype' => 1,
                'reportname' => 'โครงการแยกตามจังหวัด',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbyprovince',
                'icon' => 'icon-file-text2',
                'group_id' => 3,
                'groupname' => 'โครงการ (แยกตามภูมิภาคและจังหวัด)'
            ],
            [
                'order' => 21,
                'reporttype' => 1,
                'reportname' => 'โครงการแยกตามภูมิภาค',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbysector',
                'icon' => 'icon-file-text2',
                'group_id' => 3,
                'groupname' => 'โครงการ (แยกตามภูมิภาคและจังหวัด)'
            ],
            [
                'order' => 22,
                'reporttype' => 1,
                'reportname' => 'โครงการแยกตามสถานะของการประเมิน',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbystatus',
                'icon' => 'icon-file-text2',
                'group_id' => 7,
                'groupname' => 'สถานภาพโครงการ'
            ],
            [
                'order' => 23,
                'reporttype' => 1,
                'reportname' => 'โครงการแยกตามคะแนน',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbyscore',
                'icon' => 'icon-file-text2',
                'group_id' => 9,
                'groupname' => 'วัตถุประสงค์และผลการประเมิน'
            ],
            [
                'order' => 24,
                'reporttype' => 1,
                'reportname' => 'โครงการแยกตามเกรด',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbygrade',
                'icon' => 'icon-file-text2',
                'group_id' => 9,
                'groupname' => 'วัตถุประสงค์และผลการประเมิน'
            ],
            [
                'order' => 25,
                'reporttype' => 1,
                'reportname' => 'โครงการแยกตามที่ได้รับใบรับรอง',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbycertificate',
                'icon' => 'icon-file-text2',
                'group_id' => 9,
                'groupname' => 'วัตถุประสงค์และผลการประเมิน'
            ],
            [
                'order' => 26,
                'reporttype' => 1,
                'reportname' => 'โครงการแยกตามวัตถุประสงค์ของการประเมิน',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbyobjective',
                'icon' => 'icon-file-text2',
                'group_id' => 9,
                'groupname' => 'วัตถุประสงค์และผลการประเมิน'
            ],
            [
                'order' => 27,
                'reporttype' => 1,
                'reportname' => 'จำนวนโครงการแยกตามผลการอนุมัติ',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbyobjectiveapprove',
                'icon' => 'icon-file-text2',
                'group_id' => 9,
                'groupname' => 'วัตถุประสงค์และผลการประเมิน'
            ],
            [
                'order' => 28,
                'reporttype' => 1,
                'reportname' => 'โครงการแยกตาม Lead',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbyleader',
                'icon' => 'icon-file-text2',
                'group_id' => 11,
                'groupname' => 'TTRS STAFF'
            ],
            [
                'order' => 29,
                'reporttype' => 1,
                'reportname' => 'โครงการของ Lead แยกตามสถานะของการประเมิน Lead',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectleadbystatus',
                'icon' => 'icon-file-text2',
                'group_id' => 11,
                'groupname' => 'TTRS STAFF'
            ],
            [
                'order' => 30,
                'reporttype' => 1,
                'reportname' => 'โครงการของ Lead แยกตามประเภทอุตสาหกรรม',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectleadbyindustrygroup',
                'icon' => 'icon-file-text2',
                'group_id' => 11,
                'groupname' => 'TTRS STAFF'
            ],
            [
                'order' => 31,
                'reporttype' => 1,
                'reportname' => 'โครงการแยกตาม Expert',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbyexpert',
                'icon' => 'icon-file-text2',
                'group_id' => 12,
                'groupname' => 'Expert'
            ],
            [
                'order' => 32,
                'reporttype' => 1,
                'reportname' => 'โครงการของ Expert แยกตามสถานะของการประเมิน',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectexpertbystatus',
                'icon' => 'icon-file-text2',
                'group_id' => 12,
                'groupname' => 'Expert'
            ],
            [
                'order' => 33,
                'reporttype' => 1,
                'reportname' => 'โครงการของ Expert แยกตามประเภทอุตสาหกรรม',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectexpertbyindustrygroup',
                'icon' => 'icon-file-text2',
                'group_id' => 12,
                'groupname' => 'Expert'
            ],
            [
                'order' => 34,
                'reporttype' => 1,
                'reportname' => 'โครงการที่ได้เกรดแต่ละระดับแยกตามขนาดธุรกิจ',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectgradebybusinesssize',
                'icon' => 'icon-file-text2',
                'group_id' => 9,
                'groupname' => 'วัตถุประสงค์และผลการประเมิน'
            ],
            [
                'order' => 35,
                'reporttype' => 1,
                'reportname' => 'โครงการที่ได้เกรดแต่ละระดับแยกตามประเภทอุตสาหกรรม',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectgradebyindustrygroup',
                'icon' => 'icon-file-text2',
                'group_id' => 9,
                'groupname' => 'วัตถุประสงค์และผลการประเมิน'
            ],
            [
                'order' => 36,
                'reporttype' => 1,
                'reportname' => 'โครงการตามขนาดธุรกิจในแต่ละประเภทอุตสาหกรรม',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbusinesssizebyindustrygroup',
                'icon' => 'icon-file-text2',
                'group_id' => 9,
                'groupname' => 'วัตถุประสงค์และผลการประเมิน'
            ],
            [
                'order' => 37,
                'reporttype' => 1,
                'reportname' => 'โครงการตามขนาดธุรกิจในแต่ละภูมิภาค',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbusinesssizebysector',
                'icon' => 'icon-file-text2',
                'group_id' => 3,
                'groupname' => 'โครงการ (แยกตามภูมิภาคและจังหวัด)'
            ],
            [
                'order' => 38,
                'reporttype' => 1,
                'reportname' => 'โครงการตามประเภทอุตสาหกรรมในแต่ละภูมิภาค',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectindustrygroupbysector',
                'icon' => 'icon-file-text2',
                'group_id' => 3,
                'groupname' => 'โครงการ (แยกตามภูมิภาคและจังหวัด)'
            ],
            [
                'order' => 39,
                'reporttype' => 1,
                'reportname' => 'โครงการที่อยู่ระหว่างการประเมินทั้งหมด',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectall',
                'icon' => 'icon-file-text2',
                'group_id' => 8,
                'groupname' => 'On-Process'
            ],
            [
                'order' => 40,
                'reporttype' => 1,
                'reportname' => 'โครงการที่อยู่ระหว่างการประเมินของ Lead แยกรายคน',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectstatusbyleader',
                'icon' => 'icon-file-text2',
                'group_id' => 8,
                'groupname' => 'On-Process'
            ],
            [
                'order' => 41,
                'reporttype' => 1,
                'reportname' => 'โครงการที่อยู่ระหว่างการประเมินของ Lead แยกรายอุตสาหกรรม',
                'reportroute' => 'dashboard.admin.realtimereport.project.leadprojectstatusbyindustrygroup',
                'icon' => 'icon-file-text2',
                'group_id' => 8,
                'groupname' => 'On-Process'
            ],
            [
                'order' => 42,
                'reporttype' => 1,
                'reportname' => 'โครงการที่อยู่ระหว่างการประเมินของ Lead ในแต่ละภูมิภาค',
                'reportroute' => 'dashboard.admin.realtimereport.project.leadprojectstatusbysector',
                'icon' => 'icon-file-text2',
                'group_id' => 8,
                'groupname' => 'On-Process'
            ],
            [
                'order' => 43,
                'reporttype' => 1,
                'reportname' => 'โครงการที่อยู่ระหว่างการประเมินของ Lead ตามขนาดธุรกิจ',
                'reportroute' => 'dashboard.admin.realtimereport.project.leadprojectstatusbybusinesssize',
                'icon' => 'icon-file-text2',
                'group_id' => 8,
                'groupname' => 'On-Process'
            ],
            [
                'order' => 44,
                'reporttype' => 1,
                'reportname' => 'จำนวนผู้รับผิดชอบ/ผู้เข้าร่วมประเมินโครงการในแต่ละโครงการ Lead / Co-lead / Expert (ภายใน-ภายนอก)',
                'reportroute' => 'dashboard.admin.realtimereport.project.projectbyleadcoleadexpert',
                'icon' => 'icon-file-text2',
                'group_id' => 8,
                'groupname' => 'On-Process'
            ],
            [
                'order' => 45,
                'reporttype' => 2,
                'reportname' => 'เจ้าหน้าที่ TTRS',
                'reportroute' => 'dashboard.admin.realtimereport.ttrsofficer',
                'icon' => 'icon-users2',
                'group_id' => 11,
                'groupname' => 'TTRS STAFF'
            ],
            [
                'order' => 46,
                'reporttype' => 3,
                'reportname' => 'ผู้เชี่ยวชาญ',
                'reportroute' => 'dashboard.admin.realtimereport.expert',
                'icon' => 'icon-users2',
                'group_id' => 12,
                'groupname' => 'Expert'
            ],
            [
                'order' => 47,
                'reporttype' => 4,
                'reportname' => 'เว็บไซต์',
                'reportroute' => 'dashboard.admin.realtimereport.website.visit',
                'icon' => 'icon-IE',
                'group_id' => 13,
                'groupname' => 'Website'
            ]
        ]);
    }
}
