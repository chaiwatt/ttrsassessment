<?php

use Illuminate\Database\Seeder;

class RegisteredCapitalTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('registered_capital_types')->insert([
            [
                'name' => 'ประเภทที่ 1',
                'detail' => 'ทุนจดทะเบียนไม่ถึง 1 ล้านบาท',
                'min' => 0,
                'max' => 1000000,
            ],
            [
                'name' => 'ประเภทที่ 2',
                'detail' => 'ทุนจดทะเบียน 1 ล้านบาท แต่ไม่ถึง 5 ล้านบาท',
                'min' => 1000000,
                'max' => 5000000,
            ],
            [
                'name' => 'ประเภทที่ 3',
                'detail' => 'ทุนจดทะเบียน 5 ล้านบาท แต่ไม่ถึง 10 ล้านบาท',
                'min' => 5000000,
                'max' => 10000000,
            ],
            [
                'name' => 'ประเภทที่ 4',
                'detail' => 'ทุนจดทะเบียน ตั้งแต่ 10 ล้านบาท ขึ้นไป',
                'min' => 10000000,
                'max' => 100000000000,
            ]
        ]);
    }
}
