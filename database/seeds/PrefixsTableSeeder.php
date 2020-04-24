<?php

use Illuminate\Database\Seeder;

class PrefixsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prefixes')->insert([
            [
                'name' => 'นาง'
            ],
            [
                'name' => 'นาง'
            ],
            [
                'name' => 'นางสาว'
            ]
        ]);
    }
}
