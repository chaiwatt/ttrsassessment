<?php

use Illuminate\Database\Seeder;

class BusinessPlanActiveStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_plan_active_statuses')->insert([
            [
                'name' => 'Active'
            ],
            [
                'name' => 'In Active'
            ]
        ]);
    }
}
