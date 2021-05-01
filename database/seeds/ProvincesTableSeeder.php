<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->insert(
            [
                [
                   'code' => '10',
                   'name' => 'กรุงเทพมหานคร',
                   'map_code' => '2'
                ],
                [
                   'code' => '11',
                   'name' => 'สมุทรปราการ',
                   'map_code' => '4'
                ],
                [
                   'code' => '12',
                   'name' => 'นนทบุรี',
                   'map_code' => '2'
                ],
                [
                   'code' => '13',
                   'name' => 'ปทุมธานี',
                   'map_code' => '2'
                ],
                [
                   'code' => '14',
                   'name' => 'พระนครศรีอยุธยา',
                   'map_code' => '2'
                ],
                [
                   'code' => '15',
                   'name' => 'อ่างทอง',
                   'map_code' => '2'
                ],
                [
                   'code' => '16',
                   'name' => 'ลพบุรี',
                   'map_code' => '2'
                ],
                [
                   'code' => '17',
                   'name' => 'สิงห์บุรี',
                   'map_code' => '2'
                ],
                [
                   'code' => '18',
                   'name' => 'ชัยนาท',
                   'map_code' => '2'
                ],
                [
                   'code' => '19',
                   'name' => 'สระบุรี',
                   'map_code' => '2'
                ],
                [
                   'code' => '20',
                   'name' => 'ชลบุรี',
                   'map_code' => '4'
                ],
                [
                   'code' => '21',
                   'name' => 'ระยอง',
                   'map_code' => '4'
                ],
                [
                   'code' => '22',
                   'name' => 'จันทบุรี',
                   'map_code' => '4'
                ],
                [
                   'code' => '23',
                   'name' => 'ตราด',
                   'map_code' => '4'
                ],
                [
                   'code' => '24',
                   'name' => 'ฉะเชิงเทรา',
                   'map_code' => '4'
                ],
                [
                   'code' => '25',
                   'name' => 'ปราจีนบุรี',
                   'map_code' => '4'
                ],
                [
                   'code' => '26',
                   'name' => 'นครนายก',
                   'map_code' => '4'
                ],
                [
                   'code' => '27',
                   'name' => 'สระแก้ว',
                   'map_code' => '4'
                ],
                [
                   'code' => '30',
                   'name' => 'นครราชสีมา',
                   'map_code' => '3'
                ],
                [
                   'code' => '31',
                   'name' => 'บุรีรัมย์',
                   'map_code' => '3'
                ],
                [
                   'code' => '32',
                   'name' => 'สุรินทร์',
                   'map_code' => '3'
                ],
                [
                   'code' => '33',
                   'name' => 'ศรีสะเกษ',
                   'map_code' => '3'
                ],
                [
                   'code' => '34',
                   'name' => 'อุบลราชธานี',
                   'map_code' => '3'
                ],
                [
                   'code' => '35',
                   'name' => 'ยโสธร',
                   'map_code' => '3'
                ],
                [
                   'code' => '36',
                   'name' => 'ชัยภูมิ',
                   'map_code' => '3'
                ],
                [
                   'code' => '37',
                   'name' => 'อำนาจเจริญ',
                   'map_code' => '3'
                ],
                [
                   'code' => '39',
                   'name' => 'หนองบัวลำภู',
                   'map_code' => '3'
                ],
                [
                   'code' => '40',
                   'name' => 'ขอนแก่น',
                   'map_code' => '3'
                ],
                [
                   'code' => '41',
                   'name' => 'อุดรธานี',
                   'map_code' => '3'
                ],
                [
                   'code' => '42',
                   'name' => 'เลย',
                   'map_code' => '3'
                ],
                [
                   'code' => '43',
                   'name' => 'หนองคาย',
                   'map_code' => '3'
                ],
                [
                   'code' => '44',
                   'name' => 'มหาสารคาม',
                   'map_code' => '3'
                ],
                [
                   'code' => '45',
                   'name' => 'ร้อยเอ็ด',
                   'map_code' => '3'
                ],
                [
                   'code' => '46',
                   'name' => 'กาฬสินธุ์',
                   'map_code' => '3'
                ],
                [
                   'code' => '47',
                   'name' => 'สกลนคร',
                   'map_code' => '3'
                ],
                [
                   'code' => '48',
                   'name' => 'นครพนม',
                   'map_code' => '3'
                ],
                [
                   'code' => '49',
                   'name' => 'มุกดาหาร',
                   'map_code' => '3'
                ],
                [
                   'code' => '97',
                   'name' => 'บึงกาฬ',
                   'map_code' => '3'
                ],  
                [
                   'code' => '50',
                   'name' => 'เชียงใหม่',
                   'map_code' => '1'
                ],
                [
                   'code' => '51',
                   'name' => 'ลำพูน',
                   'map_code' => '1'
                ],
                [
                   'code' => '52',
                   'name' => 'ลำปาง',
                   'map_code' => '1'
                ],
                [
                   'code' => '53',
                   'name' => 'อุตรดิตถ์',
                   'map_code' => '1'
                ],
                [
                   'code' => '54',
                   'name' => 'แพร่',
                   'map_code' => '1'
                ],
                [
                   'code' => '55',
                   'name' => 'น่าน',
                   'map_code' => '1'
                ],
                [
                   'code' => '56',
                   'name' => 'พะเยา',
                   'map_code' => '1'
                ],
                [
                   'code' => '57',
                   'name' => 'เชียงราย',
                   'map_code' => '1'
                ],
                [
                   'code' => '58',
                   'name' => 'แม่ฮ่องสอน',
                   'map_code' => '1'
                ],
                [
                   'code' => '60',
                   'name' => 'นครสวรรค์',
                   'map_code' => '1'
                ],
                [
                   'code' => '61',
                   'name' => 'อุทัยธานี',
                   'map_code' => '1'
                ],
                [
                   'code' => '62',
                   'name' => 'กำแพงเพชร',
                   'map_code' => '1'
                ],
                [
                   'code' => '63',
                   'name' => 'ตาก',
                   'map_code' => '1'
                ],
                [
                   'code' => '64',
                   'name' => 'สุโขทัย',
                   'map_code' => '1'
                ],
                [
                   'code' => '65',
                   'name' => 'พิษณุโลก',
                   'map_code' => '1'
                ],
                [
                   'code' => '66',
                   'name' => 'พิจิตร',
                   'map_code' => '1'
                ],
                [
                   'code' => '67',
                   'name' => 'เพชรบูรณ์',
                   'map_code' => '1'
                ],
                [
                   'code' => '70',
                   'name' => 'ราชบุรี',
                   'map_code' => '5'
                ],
                [
                   'code' => '71',
                   'name' => 'กาญจนบุรี',
                   'map_code' => '5'
                ],
                [
                   'code' => '72',
                   'name' => 'สุพรรณบุรี',
                   'map_code' => '5'
                ],
                [
                   'code' => '73',
                   'name' => 'นครปฐม',
                   'map_code' => '5'
                ],
                [
                   'code' => '74',
                   'name' => 'สมุทรสาคร',
                   'map_code' => '5'
                ],
                [
                   'code' => '75',
                   'name' => 'สมุทรสงคราม',
                   'map_code' => '5'
                ],
                [
                   'code' => '76',
                   'name' => 'เพชรบุรี',
                   'map_code' => '5'
                ],
                [
                   'code' => '77',
                   'name' => 'ประจวบคีรีขันธ์',
                   'map_code' => '5'
                ],
                [
                   'code' => '80',
                   'name' => 'นครศรีธรรมราช',
                   'map_code' => '6'
                ],
                [
                   'code' => '81',
                   'name' => 'กระบี่',
                   'map_code' => '6'
                ],
                [
                   'code' => '82',
                   'name' => 'พังงา',
                   'map_code' => '6'
                ],
                [
                   'code' => '83',
                   'name' => 'ภูเก็ต',
                   'map_code' => '6'
                ],
                [
                   'code' => '84',
                   'name' => 'สุราษฎร์ธานี',
                   'map_code' => '6'
                ],
                [
                   'code' => '85',
                   'name' => 'ระนอง',
                   'map_code' => '6'
                ],
                [
                   'code' => '86',
                   'name' => 'ชุมพร',
                   'map_code' => '6'
                ],
                [
                   'code' => '90',
                   'name' => 'สงขลา',
                   'map_code' => '6'
                ],
                [
                   'code' => '91',
                   'name' => 'สตูล',
                   'map_code' => '6'
                ],
                [
                   'code' => '92',
                   'name' => 'ตรัง',
                   'map_code' => '6'
                ],
                [
                   'code' => '93',
                   'name' => 'พัทลุง',
                   'map_code' => '6'
                ],
                [
                   'code' => '94',
                   'name' => 'ปัตตานี',
                   'map_code' => '6'
                ],
                [
                   'code' => '95',
                   'name' => 'ยะลา',
                   'map_code' => '6'
                ],
                [
                   'code' => '96',
                   'name' => 'นราธิวาส',
                   'map_code' => '6'
                ]          
        ]);
    }
}
