<?php

use Illuminate\Database\Seeder;

class EvStatusTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ev_statuses')->insert([
            [
                'name' => 'ยังไม่ได้ส่ง'
            ],
            [
                'name' => 'Admin พิจารณา'
            ],
            [
                'name' => 'Manager พิจารณา'
            ],
            [
                'name' => 'ผ่านการอนุมัติ'
            ]
        ]);
    }
}
