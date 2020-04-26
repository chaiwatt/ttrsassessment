<?php

use Illuminate\Database\Seeder;

class EducationBranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('education_branches')->insert([
            [
                'name' => 'การจัดการ'
            ],
            [
                'name' => 'การตลาด'
            ]
        ]);
    }
}
