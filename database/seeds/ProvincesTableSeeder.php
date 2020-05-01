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
                   'map_code' => 'TH.BG'
                ],
                [
                   'code' => '11',
                   'name' => 'สมุทรปราการ',
                   'map_code' => 'TH.SP'
                ],
                [
                   'code' => '12',
                   'name' => 'นนทบุรี',
                   'map_code' => 'TH.NO'
                ],
                [
                   'code' => '13',
                   'name' => 'ปทุมธานี',
                   'map_code' => 'TH.PT'
                ],
                [
                   'code' => '14',
                   'name' => 'พระนครศรีอยุธยา',
                   'map_code' => 'TH.AU'
                ],
                [
                   'code' => '15',
                   'name' => 'อ่างทอง',
                   'map_code' => 'TH.AT'
                ],
                [
                   'code' => '16',
                   'name' => 'ลพบุรี',
                   'map_code' => 'TH.LB'
                ],
                [
                   'code' => '17',
                   'name' => 'สิงห์บุรี',
                   'map_code' => 'TH.SB'
                ],
                [
                   'code' => '18',
                   'name' => 'ชัยนาท',
                   'map_code' => 'TH.CN'
                ],
                [
                   'code' => '19',
                   'name' => 'สระบุรี',
                   'map_code' => 'TH.SR'
                ],
                [
                   'code' => '20',
                   'name' => 'ชลบุรี',
                   'map_code' => 'TH.CB'
                ],
                [
                   'code' => '21',
                   'name' => 'ระยอง',
                   'map_code' => 'TH.RY'
                ],
                [
                   'code' => '22',
                   'name' => 'จันทบุรี',
                   'map_code' => 'TH.CT'
                ],
                [
                   'code' => '23',
                   'name' => 'ตราด',
                   'map_code' => 'TH.TT'
                ],
                [
                   'code' => '24',
                   'name' => 'ฉะเชิงเทรา',
                   'map_code' => 'TH.CC'
                ],
                [
                   'code' => '25',
                   'name' => 'ปราจีนบุรี',
                   'map_code' => 'TH.PB'
                ],
                [
                   'code' => '26',
                   'name' => 'นครนายก',
                   'map_code' => 'TH.NN'
                ],
                [
                   'code' => '27',
                   'name' => 'สระแก้ว',
                   'map_code' => 'TH.SK'
                ],
                [
                   'code' => '30',
                   'name' => 'นครราชสีมา',
                   'map_code' => 'TH.NR'
                ],
                [
                   'code' => '31',
                   'name' => 'บุรีรัมย์',
                   'map_code' => 'TH.BR'
                ],
                [
                   'code' => '32',
                   'name' => 'สุรินทร์',
                   'map_code' => 'TH.SU'
                ],
                [
                   'code' => '33',
                   'name' => 'ศรีสะเกษ',
                   'map_code' => 'TH.SI'
                ],
                [
                   'code' => '34',
                   'name' => 'อุบลราชธานี',
                   'map_code' => 'TH.UR'
                ],
                [
                   'code' => '35',
                   'name' => 'ยโสธร',
                   'map_code' => 'TH.YS'
                ],
                [
                   'code' => '36',
                   'name' => 'ชัยภูมิ',
                   'map_code' => 'TH.CY'
                ],
                [
                   'code' => '37',
                   'name' => 'อำนาจเจริญ',
                   'map_code' => 'TH.AC'
                ],
                [
                   'code' => '39',
                   'name' => 'หนองบัวลำภู',
                   'map_code' => 'TH.NB'
                ],
                [
                   'code' => '40',
                   'name' => 'ขอนแก่น',
                   'map_code' => 'TH.KK'
                ],
                [
                   'code' => '41',
                   'name' => 'อุดรธานี',
                   'map_code' => 'TH.UN'
                ],
                [
                   'code' => '42',
                   'name' => 'เลย',
                   'map_code' => 'TH.LE'
                ],
                [
                   'code' => '43',
                   'name' => 'หนองคาย',
                   'map_code' => 'TH.NK'
                ],
                [
                   'code' => '44',
                   'name' => 'มหาสารคาม',
                   'map_code' => 'TH.MS'
                ],
                [
                   'code' => '45',
                   'name' => 'ร้อยเอ็ด',
                   'map_code' => 'TH.RE'
                ],
                [
                   'code' => '46',
                   'name' => 'กาฬสินธุ์',
                   'map_code' => 'TH.KL'
                ],
                [
                   'code' => '47',
                   'name' => 'สกลนคร',
                   'map_code' => 'TH.SN'
                ],
                [
                   'code' => '48',
                   'name' => 'นครพนม',
                   'map_code' => 'TH.NF'
                ],
                [
                   'code' => '49',
                   'name' => 'มุกดาหาร',
                   'map_code' => 'TH.MD'
                ],
                [
                   'code' => '50',
                   'name' => 'เชียงใหม่',
                   'map_code' => 'TH.CM'
                ],
                [
                   'code' => '51',
                   'name' => 'ลำพูน',
                   'map_code' => 'TH.LN'
                ],
                [
                   'code' => '52',
                   'name' => 'ลำปาง',
                   'map_code' => 'TH.LG'
                ],
                [
                   'code' => '53',
                   'name' => 'อุตรดิตถ์',
                   'map_code' => 'TH.UD'
                ],
                [
                   'code' => '54',
                   'name' => 'แพร่',
                   'map_code' => 'TH.PR'
                ],
                [
                   'code' => '55',
                   'name' => 'น่าน',
                   'map_code' => 'TH.NA'
                ],
                [
                   'code' => '56',
                   'name' => 'พะเยา',
                   'map_code' => 'TH.PY'
                ],
                [
                   'code' => '57',
                   'name' => 'เชียงราย',
                   'map_code' => 'TH.CR'
                ],
                [
                   'code' => '58',
                   'name' => 'แม่ฮ่องสอน',
                   'map_code' => 'TH.MH'
                ],
                [
                   'code' => '60',
                   'name' => 'นครสวรรค์',
                   'map_code' => 'TH.NS'
                ],
                [
                   'code' => '61',
                   'name' => 'อุทัยธานี',
                   'map_code' => 'TH.UT'
                ],
                [
                   'code' => '62',
                   'name' => 'กำแพงเพชร',
                   'map_code' => 'TH.KP'
                ],
                [
                   'code' => '63',
                   'name' => 'ตาก',
                   'map_code' => 'TH.TK'
                ],
                [
                   'code' => '64',
                   'name' => 'สุโขทัย',
                   'map_code' => 'TH.SO'
                ],
                [
                   'code' => '65',
                   'name' => 'พิษณุโลก',
                   'map_code' => 'TH.PS'
                ],
                [
                   'code' => '66',
                   'name' => 'พิจิตร',
                   'map_code' => 'TH.PC'
                ],
                [
                   'code' => '67',
                   'name' => 'เพชรบูรณ์',
                   'map_code' => 'TH.PH'
                ],
                [
                   'code' => '70',
                   'name' => 'ราชบุรี',
                   'map_code' => 'TH.RT'
                ],
                [
                   'code' => '71',
                   'name' => 'กาญจนบุรี',
                   'map_code' => 'TH.KN'
                ],
                [
                   'code' => '72',
                   'name' => 'สุพรรณบุรี',
                   'map_code' => 'TH.SH'
                ],
                [
                   'code' => '73',
                   'name' => 'นครปฐม',
                   'map_code' => 'TH.NP'
                ],
                [
                   'code' => '74',
                   'name' => 'สมุทรสาคร',
                   'map_code' => 'TH.SS'
                ],
                [
                   'code' => '75',
                   'name' => 'สมุทรสงคราม',
                   'map_code' => 'TH.SM'
                ],
                [
                   'code' => '76',
                   'name' => 'เพชรบุรี',
                   'map_code' => 'TH.PE'
                ],
                [
                   'code' => '77',
                   'name' => 'ประจวบคีรีขันธ์',
                   'map_code' => 'TH.PK'
                ],
                [
                   'code' => '80',
                   'name' => 'นครศรีธรรมราช',
                   'map_code' => 'TH.NT'
                ],
                [
                   'code' => '81',
                   'name' => 'กระบี่',
                   'map_code' => 'TH.KR'
                ],
                [
                   'code' => '82',
                   'name' => 'พังงา',
                   'map_code' => 'TH.PG'
                ],
                [
                   'code' => '83',
                   'name' => 'ภูเก็ต',
                   'map_code' => 'TH.PU'
                ],
                [
                   'code' => '84',
                   'name' => 'สุราษฎร์ธานี',
                   'map_code' => 'TH.ST'
                ],
                [
                   'code' => '85',
                   'name' => 'ระนอง',
                   'map_code' => 'TH.RN'
                ],
                [
                   'code' => '86',
                   'name' => 'ชุมพร',
                   'map_code' => 'TH.CP'
                ],
                [
                   'code' => '90',
                   'name' => 'สงขลา',
                   'map_code' => 'TH.SG'
                ],
                [
                   'code' => '91',
                   'name' => 'สตูล',
                   'map_code' => 'TH.SA'
                ],
                [
                   'code' => '92',
                   'name' => 'ตรัง',
                   'map_code' => 'TH.TG'
                ],
                [
                   'code' => '93',
                   'name' => 'พัทลุง',
                   'map_code' => 'TH.PL'
                ],
                [
                   'code' => '94',
                   'name' => 'ปัตตานี',
                   'map_code' => 'TH.PI'
                ],
                [
                   'code' => '95',
                   'name' => 'ยะลา',
                   'map_code' => 'TH.YL'
                ],
                [
                   'code' => '96',
                   'name' => 'นราธิวาส',
                   'map_code' => 'TH.NW'
                ],
                [
                   'code' => '97',
                   'name' => 'บึงกาฬ',
                   'map_code' => 'TH.BK'
                ]            
        ]);
    }
}
