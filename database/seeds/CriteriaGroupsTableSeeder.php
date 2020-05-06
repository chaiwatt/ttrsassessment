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
                'name' => 'เกณฑ์การประเมินที่1',
                'industry_group_id' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'เกณฑ์การประเมินที่2',
                'industry_group_id' => 1,
                'user_id' => 1,
            ]
        ]);
    }
}