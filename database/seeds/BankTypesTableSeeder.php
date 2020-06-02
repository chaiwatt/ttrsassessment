<?php

use Illuminate\Database\Seeder;

class BankTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bank_types')->insert([
            [
                'name' => 'ออมทรัพย์'
            ],
            [
                'name' => 'กระแสรายวัน'
            ]
        ]);
    }
}
