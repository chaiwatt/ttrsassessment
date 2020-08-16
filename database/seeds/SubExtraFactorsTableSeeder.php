<?php

use Illuminate\Database\Seeder;

class SubExtraFactorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_extra_factors')->insert([
            [
                'extra_factor_id' => 2,
                'name' => 'Regulation',
            ],
            [
                'extra_factor_id' => 3,
                'name' => 'มอก',
            ],
            [
                'extra_factor_id' => 4,
                'name' => 'Bank1',
            ],
            [
                'extra_factor_id' => 4,
                'name' => 'Bank2',
            ]
        ]);
    }
}
