<?php

use Illuminate\Database\Seeder;

class ShowFinishedProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('show_finished_projects')->insert([
            [
                'name' => 'แสดง'
            ],
            [
                'name' => 'ไม่แสดง'
            ]
        ]);
    }
}
