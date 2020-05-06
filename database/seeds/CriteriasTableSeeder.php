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
            ],
            [
                'name' => 'criteria6'
            ],
            [
                'name' => 'criteria7'
            ],
            [
                'name' => 'criteria8'
            ],
            [
                'name' => 'criteria9'
            ],
            [
                'name' => 'criteria10'
            ],
            [
                'name' => 'criteria11'
            ],
            [
                'name' => 'criteria12'
            ],
            [
                'name' => 'criteria13'
            ],
            [
                'name' => 'criteria14'
            ],
            [
                'name' => 'criteria15'
            ]
        ]);
    }
}
