<?php

use Illuminate\Database\Seeder;

class PaymentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_types')->insert([
            [
                'name' => 'QR Code'
            ],
            [
                'name' => 'โอนผ่านตู้ ATM'
            ],
            [
                'name' => 'โอนผ่านเคาท์เตอร์ธนาคาร'
            ]
        ]);
    }
}
