<?php

use Illuminate\Database\Seeder;

class SignatureStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('signature_statuses')->insert([
            [
                'name' => 'ไม่ใช้'
            ],
            [
                'name' => 'ใช้'
            ]
        ]);
    }
}
