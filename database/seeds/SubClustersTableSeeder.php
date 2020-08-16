<?php

use Illuminate\Database\Seeder;

class SubClustersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_clusters')->insert([
            [
                'cluster_id' => 2,
                'name' => 'Health',
            ],
            [
                'cluster_id' => 2,
                'name' => 'Agricultural',
            ]
        ]);
    }
}
