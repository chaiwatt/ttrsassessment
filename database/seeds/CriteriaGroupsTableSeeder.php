<?php

use Illuminate\Database\Seeder;

class CriteriaGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('criteria_groups')->insert([
            [
                'name' => 'เกณฑ์การประเมินปี 2563',
                'industry_group_id' => 1,
                'version' => 1
            ]
        ]);
    }
}