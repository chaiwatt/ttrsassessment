<?php

use Illuminate\Database\Seeder;

class CompanyServiceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_service_types')->insert([
            [
                'name' => 'ผลิต'
            ],
            [
                'name' => 'บริการ'
            ]
        ]);
    }
}
