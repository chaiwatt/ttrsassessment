<?php

use Illuminate\Database\Seeder;

class ServicePagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_pages')->insert([
            [
                'titleth' => 'แนะนำบริการ',
                'bodyth' => 'แนะนำบริการ แนะนำบริการ แนะนำบริการ แนะนำบริการ แนะนำบริการ แนะนำบริการ แนะนำบริการ แนะนำบริการ แนะนำบริการ แนะนำบริการ แนะนำบริการ',
                'titleen' => 'Service',
                'bodyen' => 'service details service details service details service details service details service details service details service details',
            ]
        ]);
    }
}
