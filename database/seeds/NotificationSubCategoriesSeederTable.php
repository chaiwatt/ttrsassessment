<?php

use Illuminate\Database\Seeder;

class NotificationSubCategoriesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notification_sub_categories')->insert([
            [
                'notification_category_id' => 1,
                'name' => 'การมอบหมาย'
            ],
            [
                'notification_category_id' => 1,
                'name' => 'ขอรับการประเมิน'
            ],
            [
                'notification_category_id' => 1,
                'name' => 'ค่าธรรมเนียม'
            ],
            [
                'notification_category_id' => 1,
                'name' => 'Mini TBP'
            ],
            [
                'notification_category_id' => 1,
                'name' => 'Full TBP'
            ],
            [
                'notification_category_id' => 1,
                'name' => 'กำหนด Weight'
            ],
            [
                'notification_category_id' => 1,
                'name' => 'ลงคะแนน'
            ],
            [
                'notification_category_id' => 2,
                'name' => 'ปฎิทิน'
            ],
            [
                'notification_category_id' => 3,
                'name' => 'สรุปการประเมิน'
            ]
        ]);
    }
}
