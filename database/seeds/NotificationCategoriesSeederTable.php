<?php

use Illuminate\Database\Seeder;

class NotificationCategoriesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notification_categories')->insert([
            [
                'name' => ' โครงการ'
            ],
            [
                'name' => 'ปฏิทิน'
            ],
            [
                'name' => 'ประเมิน'
            ]
        ]);
    }
}
