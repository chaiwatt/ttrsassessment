<?php

use Illuminate\Database\Seeder;

class EducationLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('education_levels')->insert([
            [
                'name' => 'ปริญญาตรี'
            ],
            [
                'name' => 'ปริญญาโท'
            ],
            [
                'name' => 'ปริญญาเอก'
            ],
            [
                'name' => 'อื่นๆ'
            ]
        ]);
    }
}
