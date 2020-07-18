<?php

use Illuminate\Database\Seeder;

class CriteriaGroupTransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('criteria_group_transactions')->insert([
            [
                'criteria_group_id' => 1,
                'criteria_id' => 1,
            ],
            [
                'criteria_group_id' => 1,
                'criteria_id' => 2,
            ],
            [
                'criteria_group_id' => 1,
                'criteria_id' => 3,
            ],
            [
                'criteria_group_id' => 1,
                'criteria_id' => 4,
            ],
            [
                'criteria_group_id' => 1,
                'criteria_id' => 5,
            ]
        ]);
    }
}
