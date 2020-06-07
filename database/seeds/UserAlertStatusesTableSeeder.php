<?php

use Illuminate\Database\Seeder;

class UserAlertStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_alert_statuses')->insert([
            [
                'name' => 'แสดง'
            ],
            [
                'name' => 'ปิด'
            ]
        ]);
    }
}
