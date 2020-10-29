<?php

use Illuminate\Database\Seeder;

class BusinessTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_types')->insert([
            [
                'name' => 'บริษัทมหาชน',
                'user_group_id' => 1
            ],
            [
                'name' => 'บริษัทจำกัด',
                'user_group_id' => 1
            ],
            [
                'name' => 'ห้างหุ้นส่วนจำกัด',
                'user_group_id' => 1
            ],
            [
                'name' => 'ห้างหุ้นส่วนสามัญ',
                'user_group_id' => 1
            ],
            [
                'name' => 'กิจการเจ้าของคนเดียว',
                'user_group_id' => 2
            ],
            [
                'name' => 'องค์กรธุรกิจจัดตั้ง หรือจดทะเบียนภายใต้กฎหมายเฉพาะ',
                'user_group_id' => 2
            ]
        ]);
    }
}
