<?php

use Illuminate\Database\Seeder;

class ReligionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('religions')->insert([
            [
                'name' => 'พุทธ'
            ],
            [
                'name' => 'คริสต์'
            ],
            [
                'name' => 'อิสลาม'
            ]
        ]);
    }
}
