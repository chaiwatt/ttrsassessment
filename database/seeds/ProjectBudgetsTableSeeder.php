<?php

use Illuminate\Database\Seeder;

class ProjectBudgetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_budgets')->insert([
            [
                'minbudget' => 0,
                'maxbudget' => 500000,
            ],
            [
                'minbudget' => 500000,
                'maxbudget' => 1000000,
            ],
            [
                'minbudget' => 1000000,
                'maxbudget' => 10000000,
            ],
            [
                'minbudget' => 100000000,
                'maxbudget' => 100000000000
            ]
        ]);
    }
}
