<?php

use Illuminate\Database\Seeder;

class SounddexApiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sound_dex_apis')->insert([
            [
                'api' => 'iY47GQ5KH1uQa5kfLCnBPRcsGOqKinRM'
            ],
            [
                'api' => 'P70oxclgJ1BgsaTgJqqjJdE8Jf9dXQYf'
            ],
            [
                'api' => 'cZftbPb8VYDGtinRKsxzw6zKCQSlEQYd'
            ],
            [
                'api' => 'V65X4v6PO9k2xT5c5Yq1scet7EwUOgQm'
            ],
            [
                'api' => 'XXa8uiD94r1anCEre3UAgSU7W2xvhNFH'
            ]
        ]);
    }
}
