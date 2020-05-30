<?php

use Illuminate\Database\Seeder;

class AllowAssessmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('allow_assessments')->insert([
            [
                'name' => 'ไม่ยินยอมให้รับการประเมิน'
            ],
            [
                'name' => 'ยินยอมให้รับการประเมิน'
            ]
        ]);
    }
}
