<?php

use Illuminate\Database\Seeder;

class ClustersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clusters')->insert([
            [
                'name' => 'Manufacturing'
            ],
            [
                'name' => 'ICT'
            ]
        ]);
    }
}
