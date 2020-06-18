<?php

use Illuminate\Database\Seeder;

class UserGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_groups')->insert([
            [
                'name' => 'นิติบุคคล'
            ],
            [
                'name' => 'บุคคลธรรมดา'
            ]
        ]);
    }
}
