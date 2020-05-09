<?php

use Illuminate\Database\Seeder;

class MessagePrioritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('message_priorities')->insert([
            [
                'name' => 'ปกติ'
            ],
            [
                'name' => 'ด่วน'
            ]
        ]);
    }
}
