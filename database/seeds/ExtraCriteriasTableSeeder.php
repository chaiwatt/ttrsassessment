<?php

use Illuminate\Database\Seeder;

class ExtraCriteriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('extra_criterias')->insert([
            [
                'extra_category_id' => 1,
                'name' => 'Extra อย.1',
            ],
            [
                'extra_category_id' => 1,
                'name' => 'Extra อย.2',
            ],
            [
                'extra_category_id' => 1,
                'name' => 'Extra อย.3',
            ],
            [
                'extra_category_id' => 2,
                'name' => 'Extra มอก.1',
            ],
            [
                'extra_category_id' => 2,
                'name' => 'Extra มอก.2',
            ],
            [
                'extra_category_id' => 2,
                'name' => 'Extra มอก.3',
            ],
            [
                'extra_category_id' => 3,
                'name' => 'Extra Bank1',
            ],
            [
                'extra_category_id' => 3,
                'name' => 'Extra Bank2',
            ],
            [
                'extra_category_id' => 3,
                'name' => 'Extra Bank3',
            ]
        ]);
    }
}
