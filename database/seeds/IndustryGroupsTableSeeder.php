<?php

use Illuminate\Database\Seeder;

class IndustryGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('industry_groups')->insert([
            [
                'name' => 'เกตรกรรม',
            ],
            [
                'name' => 'อาหาร',
            ],
            [
                'name' => 'พลังงาน',
            ]
        ]);
    }
}
