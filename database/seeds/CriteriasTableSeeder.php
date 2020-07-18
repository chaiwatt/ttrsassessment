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
                'name' => 'criteria1'
            ],
            [
                'name' => 'criteria2'
            ],
            [
                'name' => 'criteria3'
            ],
            [
                'name' => 'criteria4'
            ],
            [
                'name' => 'criteria5'
            ]
        ]);
    }
}
