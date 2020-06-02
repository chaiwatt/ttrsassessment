<?php

use Illuminate\Database\Seeder;

class FeeTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fee_types')->insert([
            [
                'name' => 'ค่าธรรมเนียมแรกเข้า',
                'price' => 100
            ],
            [
                'name' => 'ค่าธรรมเนียมออก CERTIFICATE',
                'price' => 5000
            ]
        ]);
    }
}
