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
                'name' => 'Chief Executive Officer'
            ],
            [
                'name' => 'Chief Technology Officer'
            ],
            [
                'name' => 'Chief Marketing Officer'
            ],
            [
                'name' => 'Chief Financial Officer'
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
            ],
            [
                'name' => 'อื่น ๆ (ระบุ)'
            ]
        ]);
    }
}
