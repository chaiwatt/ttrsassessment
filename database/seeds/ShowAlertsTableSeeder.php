<?php

use Illuminate\Database\Seeder;

class ShowAlertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('show_alerts')->insert([
            [
                'name' => 'แสดง'
            ],
            [
                'name' => 'ไม่แสดง'
            ]
        ]);
    }
}
