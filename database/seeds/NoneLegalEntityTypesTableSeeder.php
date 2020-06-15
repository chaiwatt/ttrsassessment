<?php

use Illuminate\Database\Seeder;

class NoneLegalEntityTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('none_legal_entity_types')->insert([
            [
                'name' => 'กิจการเจ้าของคนเดียว'
            ],
            [
                'name' => 'การจัดตั้งห้างหุ้นส่วนสามัญ'
            ]
        ]);
    }
}
