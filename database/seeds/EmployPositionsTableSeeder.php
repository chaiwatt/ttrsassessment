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
                'name' => 'Chief Executive Officer (CEO)'
            ],
            [
                'name' => 'Chief Technology Officer (CTO)'
            ],
            [
                'name' => 'Chief Marketing Officer (CMO)'
            ],
            [
                'name' => 'Chief Financial Officer (CFO)'
            ],
            [
                'name' => 'อื่นๆ'
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
