<?php

use Illuminate\Database\Seeder;

class CriteriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('criterias')->insert([
            [
                'name' => 'criteria1',
                'weight' => 0.02
            ],
            [
                'name' => 'criteria2',
                'weight' => 0.02
            ],
            [
                'name' => 'criteria3',
                'weight' => 0.02
            ],
            [
                'name' => 'criteria4',
                'weight' => 0.02
            ],
            [
                'name' => 'criteria5',
                'weight' => 0.02
            ]
        ]);
    }
}
