<?php

use Illuminate\Database\Seeder;

class IsnotifiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('isnotifies')->insert([
            [
                'name' => 'ไม่แจ้งเตือน'
            ],
            [
                'name' => 'แจ้งเตือน'
            ]
        ]);
    }
}
