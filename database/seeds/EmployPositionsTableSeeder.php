<?php

use Illuminate\Database\Seeder;

class EmployPositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employ_positions')->insert([
            [
                'name' => 'CEO'
            ],
            [
                'name' => 'CTO'
            ],
            [
                'name' => 'CFO'
            ],
            [
                'name' => 'COO'
            ],
            [
                'name' => 'CMO'
            ],
            [
                'name' => 'นักวิจัย'
            ],
            [
                'name' => 'วิศวกร'
            ],
            [
                'name' => 'นักพัฒนา'
            ],
            [
                'name' => 'นักการผลิต'
            ]
        ]);
    }
}
