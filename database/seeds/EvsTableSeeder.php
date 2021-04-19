<?php

use Illuminate\Database\Seeder;

class EvsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('evs')->insert([
            [
                'name' => 'scoringict',
                'version' => '01',
                'status' => '5'
            ]
        ]);
    }
}
