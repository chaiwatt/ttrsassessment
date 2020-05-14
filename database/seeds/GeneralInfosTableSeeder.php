<?php

use Illuminate\Database\Seeder;

class GeneralInfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('general_infos')->insert([
            [
                'company' => 'สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ',
                'phone1' => '0-2564-7000',
                'phone2' => '0-2564-8000',
                'fax' => '0-2564-7001-5',
                'email' => 'info@nstda.or.th',
                'youtube' => 'https://youtube.com',
                'facebook' => 'https://facebook.com',
                'workdaytime' => '08.00-16.00',
                'saturdaytime' => '08.00-17.00',
                'sundaytime' => 'ปิดทำการ',
                'address' => '111 อุทยานวิทยาศาสตร์ประเทศไทย ถนนพหลโยธิน',
                'client_id' => 'zL7j0KX0S7YKYVPnRPgWFw',
                'client_secret' => 'OgolHFr9C8B4NiMsry2tZFjxAUdK9vzuzOFbifyfPzr',
                'thsmsuser' => 'karn6944',
                'thsmspass' => '8891e6',
                'verify_status_id' => 1
            ],
        ]);
    }
}
