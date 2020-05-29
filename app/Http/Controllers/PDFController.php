<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function Generate()
    {
        require_once (base_path('/vendor/notyes/thsplitlib/THSplitLib/segment.php'));
        $segment = new \Segment();
        $body = 'หาดทรายละเอียดสีขาวตัดกับท้องฟ้าและน้ำทะเลสีครามใสคือบรรยากาศของท้องทะเลไทยในช่วงของการแพร่ ระบาดไวรัสโควิด-19ส่งผลให้ประเทศไทยมีการประกาศพ.ร.ก.ฉุกเฉินและปิดบริการสถานที่ท่องเที่ยวทางธรรมชาติทั่วประเทศเสมือนกำลังสร้างความสมดุลของ ระบบนิเวศให้กลับคืนสู่ธรรมชาติอีกครั้ง ส่วนการเปิดโรงเรียน ที่ประชุม ศบค.มีความเห็นว่า เนื่องจากโรงเรียนมีขนาดต่างกันและมีจำนวนมากจึงสั่งให้ประเมินความพร้อมเป็นรายแห่ง ให้กระทรวงศึกษาประเมินอีกครั้งภายในวันที่ 15 มิ.ย.';
        $words = $segment->get_segment_array($body);
        $text = implode("|",$words);
        $data = ['title' => 'DomPDF with Laravel', 'body' => $text];
        $pdf = PDF::loadView('pdf', $data);
        return $pdf->stream('document.pdf');
    }
}
