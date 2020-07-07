<?php

use Illuminate\Database\Seeder;

class StockHoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stock_holders')->insert([
            [
                'name' => 'ไม่ใช่'
            ],
            [
                'name' => 'ใช่'
            ]
        ]);
    }
}
