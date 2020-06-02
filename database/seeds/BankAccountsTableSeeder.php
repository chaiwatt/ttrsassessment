<?php

use Illuminate\Database\Seeder;

class BankAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bank_accounts')->insert([
            [
                'bank' => 'ธนาคารกรุงไทย',
                'name' => 'สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ',
                'accountno' => '1111111111',
                'bank_type_id' => 1
            ],
            [
                'bank' => 'กสิกรไทย',
                'name' => 'สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ',
                'accountno' => '222222222',
                'bank_type_id' => 2
            ]
        ]);
    }
}