<?php

use Illuminate\Database\Seeder;

class UseInvoiceStatuswsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('use_invoice_statuses')->insert([
            [
                'name' => 'ใช้'
            ],
            [
                'name' => 'ไม่ใช้'
            ]
        ]);
    }
}
