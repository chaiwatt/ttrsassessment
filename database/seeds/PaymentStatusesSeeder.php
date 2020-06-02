<?php

use Illuminate\Database\Seeder;

class PaymentStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_statuses')->insert([
            [
                'name' => 'ค้างชำระ',
            ],
            [
                'name' => 'ชำระเงินแล้ว',
            ]
        ]);
    }
}
