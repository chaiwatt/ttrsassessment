<?php

use Illuminate\Database\Seeder;

class ExtraFactorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('extra_factors')->insert([
            [
                'sub_cluster_id' => 2,
                'name' => 'ISO',
            ],
            [
                'sub_cluster_id' => 2,
                'name' => 'มอก',
            ],
            [
                'sub_cluster_id' => 2,
                'name' => 'อย',
            ],
            [
                'sub_cluster_id' => 2,
                'name' => 'Bank Criteria',
            ]
        ]);
    }
}
