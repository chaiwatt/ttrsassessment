<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

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
                'client_id' => 'j7GPSrVYdCTx8DYFR7hj1g',
                'client_secret' => 'OQp6hut4pyeLxWnUa1STegdZ1b4QqGtgK6AIN4V8qn0',
                'thsmsuser' => 'program6944',
                'thsmspass' => Crypt::encrypt('dd9039'),
                'verify_type_id' => 1,
                'front_page_status_id' => 1
            ],
        ]);
    }
}
