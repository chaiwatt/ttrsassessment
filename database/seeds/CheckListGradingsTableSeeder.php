<?php

use Illuminate\Database\Seeder;

class CheckListGradingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('check_list_gradings')->insert([
               [
                'ev_id' => 1, 
                'pillar_id' => 1, 
                'sub_pillar_id' => 1, 
                'sub_pillar_index_id' => 4, 
                'gradea' => 5, 
                'gradeb' => 4, 
                'gradec' => 3, 
                'graded' => 2, 
                'gradee' => 1
               ],
               [
                'ev_id' => 1, 
                'pillar_id' => 1, 
                'sub_pillar_id' => 2, 
                'sub_pillar_index_id' => 5, 
                'gradea' => 5, 
                'gradeb' => 4, 
                'gradec' => 3, 
                'graded' => 2, 
                'gradee' => 1
               ],
               [
                'ev_id' => 1, 
                'pillar_id' => 1, 
                'sub_pillar_id' => 2, 
                'sub_pillar_index_id' => 6, 
                'gradea' => 5, 
                'gradeb' => 4, 
                'gradec' => 3, 
                'graded' => 2, 
                'gradee' => 1
               ],
               [
                'ev_id' => 1, 
                'pillar_id' => 1, 
                'sub_pillar_id' => 2, 
                'sub_pillar_index_id' => 7, 
                'gradea' => 5, 
                'gradeb' => 4, 
                'gradec' => 3, 
                'graded' => 2, 
                'gradee' => 1
               ],
               [
                'ev_id' => 1, 
                'pillar_id' => 1, 
                'sub_pillar_id' => 2, 
                'sub_pillar_index_id' => 8, 
                'gradea' => 5, 
                'gradeb' => 4, 
                'gradec' => 3, 
                'graded' => 2, 
                'gradee' => 1
               ],
               [
                'ev_id' => 1, 
                'pillar_id' => 1, 
                'sub_pillar_id' => 3, 
                'sub_pillar_index_id' => 11, 
                'gradea' => 5, 
                'gradeb' => 4, 
                'gradec' => 3, 
                'graded' => 2, 
                'gradee' => 1
               ],
               [
                'ev_id' => 1, 
                'pillar_id' => 1, 
                'sub_pillar_id' => 3, 
                'sub_pillar_index_id' => 12, 
                'gradea' => 5, 
                'gradeb' => 4, 
                'gradec' => 3, 
                'graded' => 2, 
                'gradee' => 1
               ],
               [
                'ev_id' => 1, 
                'pillar_id' => 2, 
                'sub_pillar_id' => 4, 
                'sub_pillar_index_id' => 15, 
                'gradea' => 5, 
                'gradeb' => 4, 
                'gradec' => 3, 
                'graded' => 2, 
                'gradee' => 1
               ],
               [
                'ev_id' => 1, 
                'pillar_id' => 2, 
                'sub_pillar_id' => 6, 
                'sub_pillar_index_id' => 21, 
                'gradea' => 5, 
                'gradeb' => 4, 
                'gradec' => 3, 
                'graded' => 2, 
                'gradee' => 1
               ],
               [
                'ev_id' => 1, 
                'pillar_id' => 2, 
                'sub_pillar_id' => 7, 
                'sub_pillar_index_id' => 26, 
                'gradea' => 5, 
                'gradeb' => 4, 
                'gradec' => 3, 
                'graded' => 2, 
                'gradee' => 1
               ],
               [
                'ev_id' => 1, 
                'pillar_id' => 3, 
                'sub_pillar_id' => 8, 
                'sub_pillar_index_id' => 27, 
                'gradea' => 5, 
                'gradeb' => 4, 
                'gradec' => 3, 
                'graded' => 2, 
                'gradee' => 1
               ],
               [
                'ev_id' => 1, 
                'pillar_id' => 3, 
                'sub_pillar_id' => 9, 
                'sub_pillar_index_id' => 29, 
                'gradea' => 4, 
                'gradeb' => 3, 
                'gradec' => 2, 
                'graded' => 1, 
                'gradee' => 0
               ],
               [
                'ev_id' => 1, 
                'pillar_id' => 3, 
                'sub_pillar_id' => 10, 
                'sub_pillar_index_id' => 32, 
                'gradea' => 5, 
                'gradeb' => 4, 
                'gradec' => 3, 
                'graded' => 2, 
                'gradee' => 1
               ],
               [
                'ev_id' => 1, 
                'pillar_id' => 3, 
                'sub_pillar_id' => 10, 
                'sub_pillar_index_id' => 34, 
                'gradea' => 5, 
                'gradeb' => 4, 
                'gradec' => 3, 
                'graded' => 2, 
                'gradee' => 1
               ],
               [
                'ev_id' => 1, 
                'pillar_id' => 4, 
                'sub_pillar_id' => 12, 
                'sub_pillar_index_id' => 38, 
                'gradea' => 5, 
                'gradeb' => 4, 
                'gradec' => 3, 
                'graded' => 2, 
                'gradee' => 1
               ]
        ]);
    }
}
