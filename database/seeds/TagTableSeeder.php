<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            [
                'name' => 'ป้ายกำกับเพจ 1',
                'slug' => 'ป้ายกำกับเพจ1'
            ],
            [
                'name' => 'ป้ายกำกับเพจ 2',
                'slug' => 'ป้ายกำกับเพจ2'
            ],
            [
                'name' => 'ป้ายกำกับเพจ 3',
                'slug' => 'ป้ายกำกับเพจ3'
            ]
        ]);
    }
}
