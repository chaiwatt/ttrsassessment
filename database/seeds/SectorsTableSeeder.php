<?php

use Illuminate\Database\Seeder;

class SectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sectors')->insert([
            [
                'name' => 'ภาคเหนือ'
            ],
            [
                'name' => 'ภาคกลาง'
            ],
            [
                'name' => 'ภาคตะวันออกเฉียงเหนือ'
            ],
            [
                'name' => 'ภาคตะวันออก'
            ],
            [
                'name' => 'ภาคตะวันตก'
            ],
            [
                'name' => 'ภาคใต้'
            ]
        ]);
    }
}
