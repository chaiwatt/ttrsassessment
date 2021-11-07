@inject('provider', 'App\Http\Controllers\DashboardAdminEvaluationResultController')

@php
    function splitText($string,$len)
    {
   
        $myArray = explode('|', $string);
        $new_string = "";
        $tmp_string = "";
        $i=0;
        foreach($myArray as $key => $word){
            $tmp_string .= $word;
            $strlen =  getStrLenTH($tmp_string);
            if($strlen > $len ){
                $tmp_string  = "";
                    $new_string .=  $word . '<br>';
                $i++;
               
            }else{
                $new_string .= $word;
            }
        }
        $check = substr($new_string, -5);
        if($check  == '<br>'){
            return (substr($new_string, 0, -4));
        }
        else{
            return ($new_string);
        }
    }

    function getStrLenTH($string)
    {
        $array = getMBStrSplit($string);
        $count = 0;
        foreach($array as $value)
        {
            $ascii = ord(iconv("UTF-8", "TIS-620", $value ));
            
            if( !( $ascii == 209 ||  ($ascii >= 212 && $ascii <= 218 ) || ($ascii >= 231 && $ascii <= 238 )) )
            {
                $count += 1;
            }
        }
        return $count;
    }

    function getMBStrSplit($string, $split_length = 1){
        mb_internal_encoding('UTF-8');
        mb_regex_encoding('UTF-8'); 
        
        $split_length = ($split_length <= 0) ? 1 : $split_length;
        $mb_strlen = mb_strlen($string, 'utf-8');
        $array = array();
        $i = 0; 
        
        while($i < $mb_strlen)
        {
            $array[] = mb_substr($string, $i, $split_length);
            $i = $i+$split_length;
        }  
        return $array;
    }
@endphp

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=1252">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>แผนธุรกิจเทคโนโลยี</title>
        <link href="{{asset('assets/dashboard/css/pdf.css')}}" rel="stylesheet" type="text/css">
        <style>
            @page {
            footer: page-footer;
            }
            @page page-landscape { size: landscape; }
            @page page-portrait { size: portrait; }
            div.landscape {
                page: page-landscape;
            }
            div.portrait {
                page: page-portrait;
            }
            body{
                font-size:12px !important;
            }
            th{
                line-height:150% !important;
                padding:5px;
            }

            td{
                line-height:120% !important;
                padding:5px;
            }
            div{
                font-size:12px !important;
            }
            .specifixpre{
                font-family: "THSarabunNew";
                margin-top: 50px !important;
                padding: 50px !important;
            }
        </style>
    </head>
    <body>

        <div class="wrapper">
            <htmlpagefooter name="page-footer">
                <div class=" right" alt="" style="font-size:11px">F-CO-TTRS-02 rev0&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<strong>เอกสารสำคัญปกปิด (Private & Confidential)</strong>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;{PAGENO}/{nb}</div>
             </htmlpagefooter>
            <div class="container" >
                <div class="box"  >
                    <img src="{{asset('assets/dashboard/images/ttrs.png')}}" style="width:110px" alt="">
                    <img src="{{asset('assets/dashboard/images/nstda.png')}}" style="width:130px;margin-right:20px" class="right" alt="">
                </div>

                <div class="box bw600 border mt20 ml30 center" style="width:600px">
                    <div class="center mt10" style="font-size:13px ;width:300px;margin-left:165px"><strong>แผนธุรกิจเทคโนโลยี</strong></div>
                    <div style="font-size:13px ;width:300px;margin-left:165px"><strong>(Technology Business Plan: TBP)</strong></div>
                    <div class="mt20 mb20 " style="font-size:13px;width:300px;margin-left:160px"><strong>ชื่อโครงการ</strong></div>
                    <div class="mb10 " style="font-size:13px;width:500px;margin-left:65px"><strong>{{$fulltbp->minitbp->project}} @if (!Empty($fulltbp->minitbp->projecteng)) ({{$fulltbp->minitbp->projecteng}})@endif</strong></div>
                </div>
                <div class="box center mt20 ">
                    <div style="font-size:13px"><strong>(PRIVATE & CONFIDENTIAL)</strong></div>
                    <div style="font-size:13px"><strong>เสนอ</strong></div>
                    <div style="font-size:13px"><strong>สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)</strong></div>
                    <div class="mt20" style="font-size:13px">โดย</div>
                    @php
                        $bussinesstype = $fulltbp->minitbp->businessplan->company->business_type_id;
                        $companyname = $fulltbp->minitbp->businessplan->company->name;
                        $fullname = $companyname;
                        if($bussinesstype == 1){
                            $fullname = ' บริษัท ' . $companyname . ' จำกัด (มหาชน)';
                        }else if($bussinesstype == 2){
                            $fullname = ' บริษัท ' . $companyname . ' จำกัด'; 
                        }else if($bussinesstype == 3){
                            $fullname = 'ห้างหุ้นส่วน ' . $companyname . ' จำกัด'; 
                        }else if($bussinesstype == 4){
                            $fullname = 'ห้างหุ้นส่วนสามัญ ' . $companyname; 
                        }
                    @endphp
                    <div class="mt20" style="font-size:13px"><strong>{{$fullname}}</strong></div>
                </div>
                <div class="box mt40 ml80">
                    @php
                         $company = $fulltbp->minitbp->businessplan->company;
                         $company_address = (!Empty($company->companyaddress->first()->address))?$company->companyaddress->first()->address:'';
                    @endphp
                    <div style="font-size:13px"><strong>ชื่อผู้เสนอโครงการ/ผู้ประสานงาน : {{$fulltbp->minitbp->contactpersonprefix->name}}{{$fulltbp->minitbp->contactname}}  {{$fulltbp->minitbp->contactlastname}}</strong></div>
                    <div style="font-size:13px">ตำแหน่ง : {{$fulltbp->minitbp->contactposition}}</div>
                    <div style="font-size:13px">ที่อยู่ : {{$company_address}}  ตำบล{{$company->companyaddress->first()->tambol->name}} อำเภอ{{$company->companyaddress->first()->amphur->name}} จังหวัด{{$company->companyaddress->first()->province->name}} {{$company->companyaddress->first()->postalcode}} </div>
                    <div style="font-size:13px">โทรศัพท์ : {{$fulltbp->minitbp->contactphone}}</div>
                    <div style="font-size:13px">E-MAIL : {{$fulltbp->minitbp->contactemail}}</div>
                    <div style="font-size:13px">Website : {{$fulltbp->minitbp->website}}</div>
                </div>
                <div class="box center mt20 mb15 ">
                    <div style="font-size:13px"><strong>แผนธุรกิจเทคโนโลยีเพื่อเข้ารับการประเมินโดย TTRS Model</strong></div>
                </div>
                <div class="box bw650 font8 border" style="background-color: #daedf3;">
                    <div class="ml10 mt10" style="font-size:13px;"><u><strong>วิธียื่นแผนธุรกิจเทคโนโลยีเพื่อเข้ารับการประเมินฯ</strong></u></div>
                    <div class="ml15 mt5" style="font-size:13px">{!!$provider::FixBreak("• ผู้ที่ประสงค์จะยื่นแผนธุรกิจเทคโนโลยีจะต้องกรอกข้อมูลในแบบฟอร์ม และยื่นเอกสารต่อสำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)")!!}</div>
                    <div class="ml15" style="font-size:13px">• กรุณาศึกษาข้อแนะนำอย่างละเอียดก่อนที่จะกรอกข้อมูลในแบบฟอร์มแผนธุรกิจเทคโนโลยี </div>
                    <div class="ml15" style="font-size:13px">• โปรดตรวจสอบและแนบเอกสารที่เกี่ยวข้องประกอบการยื่นแผนธุรกิจเทคโนโลยีให้ครบถ้วน</div> 
                    <div class="ml15 mb10" style="font-size:13px">• หากมีข้อสงสัยหรือต้องการข้อมูลเพิ่มเติม โปรดติดต่อศูนย์สนับสนุนและให้บริการประเมินจัดอันดับเทคโนโลยี สวทช. <br>&nbsp;&nbsp;E-mail: ttrs@nstda.or.th</div>
                </div>
           
                <div class="page-break"></div>
                <div class="box bw650  mt20 " style="background-color: #bdd6ee;">
                    <div style="font-size:13px"><strong>1. ข้อมูลทั่วไป</strong></div>
                </div>
                <div class="box bw650  mt20" >                     
                    <div class="ml20 mt-10" style="font-size:13px">1.1 ชื่อนิติบุคคล : {{$fullname}}</div>
                    <div class="ml20 mt0" style="font-size:13px">1.2 เลขทะเบียนนิติบุคคล : {{$fulltbp->minitbp->businessplan->company->vatno}} </div> 
                    <div class="ml20 mt0" style="font-size:13px">1.3 ปีที่จดทะเบียน : พ.ศ. {{Empty($fulltbp->minitbp->businessplan->company->registeredyear) ? '-' : $fulltbp->minitbp->businessplan->company->registeredyear}}</div>
                    <div class="ml20 mt0" style="font-size:13px">1.4 ทุนจดทะเบียน : {{number_format($fulltbp->minitbp->businessplan->company->registeredcapital,2)}} บาท</div>
                    <div class="ml20 mt0" style="font-size:13px">1.5 ทุนจดทะเบียนที่เรียกชำระแล้ว: : {{number_format($fulltbp->minitbp->businessplan->company->paidupcapital,2)}} บาท เมื่อวันที่:	{{Empty($fulltbp->minitbp->businessplan->company->paidupcapitaldate) ? '-' : $fulltbp->minitbp->businessplan->company->paidupcapitaldateth}}</div>
                    <div class="ml20 mt0" style="font-size:13px">1.6 แผนผังองค์กร (Organization Chart)	
                        <div class="box bw500 bh300 border borderdotted mt5 ml70 mb20 center">
                            <img src="{{asset($fulltbp->minitbp->businessplan->company->organizeimg)}}" class="bw500 bh300" alt="">
                        </div>
                    </div>
                    <div class="ml20 mt0" style="font-size:13px">1.7 จำนวนบุคลากรทั้งหมด&emsp;{{number_format($fulltbp->minitbp->businessplan->company->department_qty)}}&emsp;คน
                        <div class="ml50 mt0" style="font-size:13px">- ฝ่ายบริหาร&emsp;{{number_format($fulltbp->minitbp->businessplan->company->department1_qty)}}&emsp;คน</div>
                        <div class="ml50 mt0" style="font-size:13px">- ฝ่ายวิจัยและพัฒนา&emsp;{{number_format($fulltbp->minitbp->businessplan->company->department2_qty)}}&emsp;คน</div>
                        <div class="ml50 mt0" style="font-size:13px">- ฝ่ายผลิต/วิศวกรรม&emsp;{{number_format($fulltbp->minitbp->businessplan->company->department3_qty)}}&emsp;คน</div>
                        <div class="ml50 mt0" style="font-size:13px">- ฝ่ายการตลาด&emsp;{{number_format($fulltbp->minitbp->businessplan->company->department4_qty)}}&emsp;คน</div>
                        <div class="ml50 mt0" style="font-size:13px">- พนักงานทั่วไป&emsp;{{number_format($fulltbp->minitbp->businessplan->company->department5_qty)}}&emsp;คน</div>
                    </div>
                    <div class="ml20 mt0" style="font-size:13px"><strong>1.8 ประเภทของธุรกิจ</strong>
                        <div class="ml50 mt0" style="font-size:13px"><strong>1.8.1 ธุรกิจนิติบุคคล</strong>
                            <div class="ml50 mt0" style="font-size:13px"><input type="checkbox" @if ($fulltbp->minitbp->businessplan->company->business_type_id == 3) checked="checked" @endif > ห้างหุ้นส่วนจำกัด</div>
                            <div class="ml50 mt0" style="font-size:13px"><input type="checkbox" @if ($fulltbp->minitbp->businessplan->company->business_type_id == 2) checked="checked" @endif > บริษัทจำกัด</div>
                            <div class="ml50 mt0" style="font-size:13px"><input type="checkbox" @if ($fulltbp->minitbp->businessplan->company->business_type_id == 1) checked="checked" @endif > บริษัทมหาชนจำกัด</div>
                            <div class="ml50 mt0" style="font-size:13px"><input type="checkbox" @if ($fulltbp->minitbp->businessplan->company->business_type_id == 6) checked="checked" @endif > องค์กรธุรกิจจัดตั้ง หรือจดทะเบียนภายใต้กฎหมายเฉพาะ</div>
                        </div>
                        <div class="ml50 mt0" style="font-size:13px"><strong>1.8.2 ธุรกิจที่ไม่เป็นนิติบุคคล</strong>
                            <div class="ml50 mt0" style="font-size:13px"><input type="checkbox" @if ($fulltbp->minitbp->businessplan->company->business_type_id == 5) checked="checked" @endif > กิจการเจ้าของคนเดียว</div>
                            <div class="ml50 mt0" style="font-size:13px"><input type="checkbox" @if ($fulltbp->minitbp->businessplan->company->business_type_id == 4) checked="checked" @endif > การจัดตั้งห้างหุ้นส่วนสามัญ</div>
                        </div>
                    </div>
                    <div class="page-break"></div>
                    <div class="ml20 mt0" style="font-size:13px;page-break-inside: avoid;"><strong>1.9 ประวัติของบริษัท (Company Profile)</strong>
                        <div style="font-size:13px">{!!$provider::FixBreak($fulltbp->minitbp->businessplan->company->companyhistory)!!}</div>
                    </div>
                    <div class="ml20 mt0" style="font-size:13px"><strong>1.10 ข้อมูลผู้บริหารระดับสูง (CEO หรือ กรรมการผู้จัดการ)</strong>
                        <div style="page-break-inside: avoid;">
                            @php
                                $directorprefix = @$fulltbp->companyemploy->prefix->name;
                                if($directorprefix == 'อื่นๆ'){
                                    $directorprefix = @$fulltbp->companyemploy->otherprefix;
                                }
                                $directorposition = @$fulltbp->companyemploy->employposition->name;
                                if($directorposition == 'อื่นๆ'){
                                    $directorposition = @$fulltbp->companyemploy->otherposition;
                                }
                            @endphp
                            <div class="ml30 mt0" style="font-size:13px">ชื่อ-นามสกุล : {{@$directorprefix}}{{@$fulltbp->companyemploy->name}} {{@$fulltbp->companyemploy->lastname}}</div>
                            <div class="ml30 mt0" style="font-size:13px">ตำแหน่ง : {{@$directorposition}}</div>
                            <div class="ml30 mt0" style="font-size:13px">โทรศัพท์ : {{@$fulltbp->companyemploy->workphone}}</div>
                            <div class="ml30 mt0" style="font-size:13px">โทรศัพท์มือถือ : {{@$fulltbp->companyemploy->phone}}</div>
                            <div class="ml30 mt0" style="font-size:12px">อีเมล : {{@$fulltbp->companyemploy->email}}</div>
                        </div>
                        @if ($fulltbp->employeducation->count() > 0)
                            <div class="ml30 mt10" style="font-size:13px"><strong>ประวัติการศึกษา</strong>
                                <table class="mt5  border tbwrap" >
                                    <thead>
                                        <tr>
                                            <th style="font-size:13px">ระดับ</th>
                                            <th style="width:30%;font-size:13px">ชื่อสถานศึกษา</th>
                                            <th style="width:30%;font-size:13px">สาขาวิชาเอก</th>
                                            <th style="font-size:12px;text-align:center">ปีที่ศึกษา<pre style="font-family: THSarabunNew">(เริ่มต้น-สิ้นสุด)</pre></th>
                                        <tr>
                                    </thead>
                                    <tbody>
                                        @if ($fulltbp->employeducation->count() > 0)
                                            @foreach ($fulltbp->employeducation as $employeducation)
                                                <tr>
                                                    <td style="font-size:13px">
                                                    	@if ($employeducation->employeducationlevel == 'อื่นๆ')
                                                                {{$employeducation->otheremployeducationlevel}} 
                                                            @else
                                                                {{$employeducation->employeducationlevel}} 
                                                        @endif
                                                    </td>
                                                    <td style="font-size:13px">{!!splitText($provider::FixBreak2($employeducation->employeducationinstitute),15)!!}</td>
                                                    <td style="font-size:13px">{!!splitText($provider::FixBreak2($employeducation->employeducationmajor),15)!!}</td>
                                                    <td style="font-size:13px">{{$employeducation->employeducationyearstart}} - {{$employeducation->employeducationyearend}}</td>
                                                </tr>   
                                            @endforeach   
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        @if ($fulltbp->employexperience->count() > 0)
                            <div class="ml30 mt20" style="font-size:13px"><strong>ประวัติการทำงาน</strong>
                                <table class="mt5  tbwrap" >
                                    <thead>
                                        <tr>
                                            <th style="font-size:13px;text-align: center" colspan="2">ช่วงเวลาการทำงาน</th>
                                            <th style="width:30%;font-size:13px;text-align: center" rowspan="2">บริษัท</th>
                                            <th style="width:20%;font-size:13px;text-align: center" rowspan="2">ประเภทธุรกิจ</th>
                                            <th style="font-size:13px;text-align: center" rowspan="2">ตำแหน่ง<pre style="font-family: THSarabunNew">แรกเข้า</pre></th>
                                            <th style="font-size:13px;text-align: center" rowspan="2">ตำแหน่ง<pre style="font-family: THSarabunNew">ล่าสุด</pre></th>
                                        </tr>
                                        <tr>
                                            <th style="font-size:13px;width:10%;text-align: center" >เริ่มต้น</th>
                                            <th style="font-size:13px;width:10%;text-align: center">สิ้นสุด</th>
                                         
                                        <tr>
                                    </thead>
                                    <tbody>
                                        @if ($fulltbp->employexperience->count() > 0)
                                            @foreach ($fulltbp->employexperience as $employexperience)
                                                <tr>
                                                    <td style="font-size:13px;text-align: center">{{$employexperience->startdate}}</td>
                                                    <td style="font-size:13px;text-align: center">{{$employexperience->enddate}}</td>
                                                    <td style="font-size:13px;">{!!splitText($provider::FixBreak2($employexperience->company),20)!!}</td>
                                                    <td style="font-size:13px;">{!!splitText($provider::FixBreak2($employexperience->businesstype),10)!!}</td>
                                                    <td style="font-size:13px">{!!splitText($provider::FixBreak2($employexperience->startposition),7)!!}</td>
                                                    <td style="font-size:13px">{!!splitText($provider::FixBreak2($employexperience->endposition),7)!!}</td>

                                                </tr>   
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div> 
                        @endif
                        @if ($fulltbp->employtraining->count() > 0)
                            <div class="ml30 mt20" style="font-size:13px"><strong>ประวัติการฝึกอบรม</strong>
                                <table class="mt5  border tbwrap" >
                                    <thead>
                                        <tr>
                                            <th style="font-size:13px">วัน เดือน ปี</th>
                                            <th style="width:50%;font-size:13px">หลักสูตร</th>
                                            <th style="font-size:13px">หน่วยงานผู้จัด</th>
                                        <tr>
                                    </thead>
                                    <tbody>
                                        @if ($fulltbp->employtraining->count() > 0)
                                            @foreach ($fulltbp->employtraining as $employtraining)
                                                <tr>
                                                    <td style="font-size:13px">{{$employtraining->trainingdateth}}</td>
                                                    <td style="font-size:13px">{!!splitText($provider::FixBreak2($employtraining->course),25)!!}</td>
                                                    <td style="font-size:13px">{!!splitText($provider::FixBreak2($employtraining->owner),20)!!}</td>
                                                </tr>   
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>  
                        @endif
                    </div>
                    <div class="ml20 mt20" style="font-size:13px"><strong>1.11 ข้อมูลทีมบริหาร (CTO, CFO, COO, และ CMO)</strong>
                        {{-- {{$companyboards}} --}}
                        @if ($companyboards->count() > 0)
                            @foreach ($companyboards as $key => $companyemboard)
                            <div style="page-break-inside: avoid;">
                                @if ($companyboards->count() > 1)
                                    <div class="ml30 mt10" style="font-size:13px"><strong><u>ลำดับที่ {{$key +1}}</u></strong></div>
                                @endif
                                @php
                                    $companyemboardprefix = $companyemboard->prefix->name;
                                    if($companyemboardprefix == 'อื่นๆ'){
                                        $companyemboardprefix = $companyemboard->otherprefix;
                                    }
                                    $companyemboardposition = $companyemboard->employposition->name;
                                    if($companyemboardposition == 'อื่นๆ'){
                                        $companyemboardposition = $companyemboard->otherposition;
                                    }
                                @endphp
                                <div class="ml30 mt0" style="font-size:13px"> ชื่อ-นามสกุล : {{$companyemboardprefix}}{{$companyemboard->name}} {{$companyemboard->lastname}}</div>
                                <div class="ml30 mt0" style="font-size:13px"> ตำแหน่ง : {{$companyemboardposition}}</div>
                                <div class="ml30 mt0" style="font-size:13px"> โทรศัพท์ : {{$companyemboard->workphone}}</div>
                                <div class="ml30 mt0" style="font-size:13px"> โทรศัพท์มือถือ : {{$companyemboard->phone}}</div>
                                <div class="ml30 mt0" style="font-size:13px"> อีเมล : {{$companyemboard->email}}</div>
                            </div>

                                @if ($companyemboard->employeducation->count() > 0)
                                    <div class="ml30 mt20" style="page-break-inside: avoid;"><strong>ประวัติการศึกษา</strong>
                                        <table class="mt5  border tbwrap" >
                                            <thead>
                                                <tr>
                                                    <th style="font-size:13px">ระดับ</th>
                                                    <th style="width:30%;font-size:13px">ชื่อสถานศึกษา</th>
                                                    <th style="width:30%;font-size:13px">สาขาวิชาเอก</th>
                                                    <th style="font-size:12px;text-align:center">ปีที่ศึกษา<pre style="font-family: THSarabunNew">(เริ่มต้น-สิ้นสุด)</pre></th>
                                                <tr>
                                            </thead>
                                            <tbody>
                                                @if ($companyemboard->employeducation->count() > 0)
                                                    @foreach ($companyemboard->employeducation as $employeducation)
                                                        <tr>
                                                            <td style="font-size:13px">
                                                            
                                                                @if ($employeducation->employeducationlevel == 'อื่นๆ')
                                                                        {{$employeducation->otheremployeducationlevel}} 
                                                                    @else
                                                                        {{$employeducation->employeducationlevel}} 
                                                                @endif
                                                            
                                                            </td>
                                                            <td style="font-size:13px">{!!splitText($provider::FixBreak2($employeducation->employeducationinstitute),15)!!}</td>
                                                            <td style="font-size:13px">{!!splitText($provider::FixBreak2($employeducation->employeducationmajor),15)!!}</td>
                                                            <td style="font-size:13px">{{$employeducation->employeducationyearstart}} - {{$employeducation->employeducationyearend}}</td>
                                                        </tr>   
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if ($companyemboard->employexperience->count() > 0)
                                    <div class="ml30 mt20" style="page-break-inside: avoid;"><strong>ประวัติการทำงาน</strong>
                                        <table class="mt5 border tbwrap">
                                            <thead>
                                                <tr>
                                                    <th style="font-size:13px;" colspan="2">ช่วงเวลาการทำงาน</th>
                                                    <th style="width:30%;font-size:13px;" rowspan="2">บริษัท</th>
                                                    <th style="width:20%;font-size:13px;" rowspan="2">ประเภทธุรกิจ</th>
                                                    <th style="font-size:13px" rowspan="2">ตำแหน่ง<pre style="font-family: THSarabunNew">แรกเข้า</pre></th>
                                                    <th style="font-size:13px" rowspan="2">ตำแหน่ง<pre style="font-family: THSarabunNew">ล่าสุด</pre></th>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:13px;width:10%" >เริ่มต้น</th>
                                                    <th style="font-size:13px;width:10%">สิ้นสุด</th>
                                                 
                                                <tr>
                                            </thead>
                                            <tbody>
                                                @if ($companyemboard->employexperience->count() > 0)
                                                    @foreach ($companyemboard->employexperience as $employexperience)
                                                        <tr>
                                                            <td style="font-size:13px">{{$employexperience->startdate}}</td>
                                                            <td style="font-size:13px">{{$employexperience->enddate}}</td>
                                                            <td style="font-size:13px;">{!!splitText($provider::FixBreak2($employexperience->company),20)!!}</td>
                                                            <td style="font-size:13px;">{!!splitText($provider::FixBreak2($employexperience->businesstype),10)!!}</td>
                                                            <td style="font-size:13px">{!!splitText($provider::FixBreak2($employexperience->startposition),7)!!}</td>
                                                            <td style="font-size:13px">{!!splitText($provider::FixBreak2($employexperience->endposition),7)!!}</td>
                                                        </tr>   
                                                    @endforeach 
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if ($companyemboard->employtraining->count() > 0)
                                    <div class="ml30 mt20" style="page-break-inside: avoid;"><strong>ประวัติการฝึกอบรม</strong>
                                        <table class="mt5 border tbwrap" >
                                            <thead>
                                                <tr>
                                                    <th style="font-size:13px">วัน เดือน ปี</th>
                                                    <th style="width:50%;font-size:13px">หลักสูตร</th>
                                                    <th style="font-size:13px">หน่วยงานผู้จัด</th>
                                                <tr>
                                            </thead>
                                            <tbody>
                                                @if ($companyemboard->employtraining->count() > 0)
                                                    @foreach ($companyemboard->employtraining as $employtraining)
                                                        <tr>
                                                            <td style="font-size:13px">{{$employtraining->trainingdateth}}</td>
                                                            <td style="font-size:13px">{!!splitText($provider::FixBreak2($employtraining->course),25)!!}</td>
                                                            <td style="font-size:13px">{!!splitText($provider::FixBreak2($employtraining->owner),20)!!}</td>
                                                        </tr>   
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>  
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="ml20 mt20 " style="font-size:13px;page-break-inside: avoid;"><strong>1.12 บัญชีรายชื่อผู้ถือหุ้น</strong>
                        <table class="ml30 mt5 " >
                            <thead>
                                <tr>
                                    <th style="width:35%">รายชื่อผู้ถือหุ้น</th>
                                    <th style="width:65%;text-align:center;">ความสัมพันธ์ CEO</th>
                                <tr>
                            </thead>
                            <tbody>
                                @if ($companystockholders->count() > 0)
                                    @foreach ($companystockholders as $key => $companystockholder)
                                        <tr>
                                            <td style="font-size:13px">{{$companystockholder->name}}</td>
                                            <td style="text-align:center;">{{$companystockholder->ceorelation}}</td>
                                        </tr>   
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="ml20 mt20" style="font-size:13px;page-break-inside: avoid"><strong>1.13 ข้อมูลพนักงานด้านการวิจัย พัฒนา การผลิต และวิศวกรรม</strong>
                        @if ($companyemploys->count() > 0)
                            @foreach ($companyemploys as $key => $companyemploy)
                                <div style="page-break-inside: avoid;">
                                    @php
                                        $position = $companyemploy->employposition->name;
                                        if ($position == 'อื่น ๆ (ระบุ)') {
                                            $position = $companyemploy->otherposition ;
                                        }
                                    @endphp

                                    @if ($companyemploys->count() > 1)
                                    <div class="ml30 mt10" style="font-size:13px"><strong><u>ลำดับที่ {{$key +1}}</u></strong></div>
                                    @endif
                                    <div class="ml30 mt0" style="font-size:13px"> ชื่อ-นามสกุล : {{$companyemploy->prefix->name}}{{$companyemploy->name}} {{$companyemploy->lastname}}</div>
                                    <div class="ml30 mt0" style="font-size:13px"> ตำแหน่ง : {{$position}}</div>
                                    <div class="ml30 mt0" style="font-size:13px"> โทรศัพท์ : {{$companyemploy->workphone}}</div>
                                    <div class="ml30 mt0" style="font-size:13px"> โทรศัพท์มือถือ : {{$companyemploy->phone}}</div>
                                    <div class="ml30 mt0" style="font-size:13px"> อีเมล : {{$companyemploy->email}}</div>
                                </div>
                                @if ($companyemploy->employeducation->count() > 0)
                                    <div class="ml30 mt20" style="page-break-inside: avoid;"><strong>ประวัติการศึกษา</strong>
                                        <table class="mt5  border tbwrap" >
                                            <thead>
                                                <tr>
                                                    <tr>
                                                        <th style="font-size:13px">ระดับ</th>
                                                        <th style="width:30%;font-size:13px">ชื่อสถานศึกษา</th>
                                                        <th style="width:30%;font-size:13px">สาขาวิชาเอก</th>
                                                        <th style="font-size:12px;text-align:center">ปีที่ศึกษา<pre style="font-family: THSarabunNew">(เริ่มต้น-สิ้นสุด)</pre></th>
                                                    <tr>
                                                <tr>
                                            </thead>
                                            <tbody>
                                                @if ($companyemploy->employeducation->count() > 0)
                                                    @foreach ($companyemploy->employeducation as $employeducation)
                                                        <tr>
                                                            <td style="font-size:13px">
                                                                @if ($employeducation->employeducationlevel == 'อื่นๆ')
                                                                        {{$employeducation->otheremployeducationlevel}} 
                                                                    @else
                                                                        {{$employeducation->employeducationlevel}} 
                                                                @endif
                                                            
                                                            </td>
                                                            <td style="font-size:13px">{!!splitText($provider::FixBreak2($employeducation->employeducationinstitute),15)!!}</td>
                                                            <td style="font-size:13px">{!!splitText($provider::FixBreak2($employeducation->employeducationmajor),15)!!}</td>
                                                            <td style="font-size:13px">{{$employeducation->employeducationyearstart}} - {{$employeducation->employeducationyearend}}</td>
                                                        </tr>   
                                                    @endforeach
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if ($companyemploy->employexperience->count() > 0)
                                    <div class="ml30 mt20" style="font-size:13px;page-break-inside: avoid;"><strong>ประวัติการทำงาน</strong>
                                        <table class="mt5  tbwrap" >
                                            <thead>
                                                <tr>
                                                    <th style="font-size:13px;" colspan="2">ช่วงเวลาการทำงาน</th>
                                                    <th style="width:30%;font-size:13px;" rowspan="2">บริษัท</th>
                                                    <th style="width:20%;font-size:13px;" rowspan="2">ประเภทธุรกิจ</th>
                                                    <th style="font-size:13px" rowspan="2">ตำแหน่ง<pre style="font-family: THSarabunNew">แรกเข้า</pre></th>
                                                    <th style="font-size:13px" rowspan="2">ตำแหน่ง<pre style="font-family: THSarabunNew">ล่าสุด</pre></th>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:13px;width:50px" >เริ่มต้น</th>
                                                    <th style="font-size:13px;width:50px">สิ้นสุด</th>
                                                 
                                                <tr>
                                            </thead>
                                            <tbody>
                                                @if ($companyemploy->employexperience->count() > 0)
                                                    @foreach ($companyemploy->employexperience as $employexperience)
                                                        <tr>
                                                            {{-- <td style="font-size:13px">{{$employexperience->startdate}}</td>
                                                            <td style="font-size:13px">{{$employexperience->enddate}}</td>
                                                            <td style="font-size:13px">{!!$provider::FixBreak($employexperience->company)!!}</td>
                                                            <td style="font-size:13px">{{$employexperience->businesstype}}</td>
                                                            <td style="font-size:13px">{{$employexperience->startposition}}</td>
                                                            <td style="font-size:13px">{{$employexperience->endposition}}</td> --}}

                                                            <td style="font-size:13px">{{$employexperience->startdate}}</td>
                                                            <td style="font-size:13px">{{$employexperience->enddate}}</td>
                                                            <td style="font-size:13px;">{!!splitText($provider::FixBreak2($employexperience->company),20)!!}</td>
                                                            <td style="font-size:13px;">{!!splitText($provider::FixBreak2($employexperience->businesstype),10)!!}</td>
                                                            <td style="font-size:13px">{!!splitText($provider::FixBreak2($employexperience->startposition),7)!!}</td>
                                                            <td style="font-size:13px">{!!splitText($provider::FixBreak2($employexperience->endposition),7)!!}</td>
                                                        </tr>   
                                                    @endforeach  
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if ($companyemploy->employtraining->count() > 0)
                                    <div class="ml30 mt20" style="font-size:13px;page-break-inside: avoid;"><strong>ประวัติการฝึกอบรม</strong>
                                        <table class="mt5  border tbwrap" >
                                            <thead>
                                                <tr>
                                                    <th style="font-size:13px">วัน เดือน ปี</th>
                                                    <th style="width:50%;font-size:13px">หลักสูตร</th>
                                                    <th style="font-size:13px">หน่วยงานผู้จัด</th>
                                                <tr>
                                            </thead>
                                            <tbody>
                                                @if ($companyemploy->employtraining->count() > 0)
                                                    @foreach ($companyemploy->employtraining as $employtraining)
                                                        <tr>
                                                            <td style="font-size:13px">{{$employtraining->trainingdateth}}</td>
                                                            <td style="font-size:13px">{!!splitText($provider::FixBreak2($employtraining->course),25)!!}</td>
                                                            <td style="font-size:13px">{!!splitText($provider::FixBreak2($employtraining->owner),20)!!}</td>
                                                        </tr>   
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>  
                                @endif
                            @endforeach
                        @endif

                    </div>
                    @php
                        $respprefix = $fulltbp->fulltbpresponsibleperson->prefix->name;
                        if ($fulltbp->fulltbpresponsibleperson->prefix_id == 5) {
                            $respprefix = $fulltbp->fulltbpresponsibleperson->otherprefix;
                        }
                    @endphp
                   
                    <div class="ml20 mt20" style="font-size:13px"><strong>1.14 ข้อมูลผู้รับผิดชอบหลักในโครงการ (ผู้จัดการโครงการ/หัวหน้าโครงการ)</strong>
                        <div class="ml30 mt0" style="font-size:13px"> ชื่อ-นามสกุล : {{$respprefix}}{{$fulltbp->fulltbpresponsibleperson->name}} {{$fulltbp->fulltbpresponsibleperson->lastname}}</div>
                        <div class="ml30 mt0" style="font-size:13px"> ตำแหน่ง : {{$fulltbp->fulltbpresponsibleperson->position}}</div>
                        <div class="ml30 mt0" style="font-size:13px"> โทรศัพท์ : {{$fulltbp->fulltbpresponsibleperson->phone1}} ต่อ {{$generalinfo->phone1_ext}}</div>
                        <div class="ml30 mt0" style="font-size:13px"> โทรศัพท์มือถือ : {{$fulltbp->fulltbpresponsibleperson->phone2}}</div>
                        <div class="ml30 mt0" style="font-size:13px"> อีเมล : {{$fulltbp->fulltbpresponsibleperson->email}}</div>
                    </div>
                </div>
                <div style="page-break-inside: avoid;">
                    <div class="box bw650  mt20 " style="background-color: #bdd6ee;">
                        <div style="font-size:13px"><strong>2. ภาพรวมโครงการที่ขอรับการประเมิน</strong></div>
                    </div>
                    <div class="ml30 mt10" style="font-size:13px"><strong>2.1 ชื่อโครงการ :</strong> {{$fulltbp->minitbp->project}}</div>
                </div>
                <div class="box bw650 " >
                    
                    <div class="ml30 mt0" style="font-size:13px"> <strong>2.2 ชื่อโครงการ (ภาษาอังกฤษ) :</strong> {{$fulltbp->minitbp->projecteng}}</div>
                   
                    <div class="ml30 mt0" style="font-size:13px;page-break-inside: avoid;"><strong>2.3 บทคัดย่อโครงการ :</strong>
                        <div style="margin-top:-15px;font-size:13px">{!!$provider::FixBreak($fulltbp->abtract)!!}</div>
                    </div>
                    <div class="ml30 mt0" style="font-size:13px;page-break-inside: avoid;"><strong>2.4 ผลิตภัณฑ์หลัก สินค้า / บริการ ของโครงการ :</strong>
                        <div style="margin-top:-15px;font-size:13px">{!!$provider::FixBreak($fulltbp->mainproduct)!!}</div>
                    </div>
                    <div class="ml30 mt0" style="font-size:13px;page-break-inside: avoid;"><strong>2.5 จุดเด่นของผลิตภัณฑ์หลัก สินค้า / บริการ ของโครงการ :</strong>
                        <div style="margin-top:-15px;font-size:13px">{!!$provider::FixBreak($fulltbp->productdetail)!!}</div>
                    </div>
                    {{-- <div class="ml30 mt0" style="font-size:13px"> <strong>2.4 ผลิตภัณฑ์หลัก สินค้า / บริการ ของโครงการ :</strong><span style="text-align:justify">{!!$provider::FixBreak($fulltbp->mainproduct)!!}</span></div> --}}
                    {{-- <div class="ml30 mt0" style="font-size:13px"> <strong>2.5 จุดเด่นของผลิตภัณฑ์หลัก สินค้า / บริการ ของโครงการ :</strong><span style="text-align:justify">{!!$provider::FixBreak($fulltbp->productdetail)!!}</span></div> --}}
                    {{-- <div style="page-break-inside: avoid;"> --}}
                    <div class="ml30 mt0" style="font-size:13px;margin-buttom:-20px;page-break-inside: avoid;"> <strong>2.6 ข้อมูลเทคโนโลยี</strong>
                        <div class="mt0" style="font-size:13px;page-break-inside: avoid;"><strong>2.6.1 การพัฒนาเทคโนโลยี  :</strong>
                            <div style="margin-top:-15px;font-size:13px">{!!$provider::FixBreak($fulltbp->techdev)!!}</div>
                        </div>
                    </div>

                    <div class="ml30" style="font-size:13px;page-break-inside: avoid;"><strong>ระดับของเทคโนโลยีและความใหม่ของผลิตภัณฑ์</strong>
                    </div> 
                        <table class="mt5 tbwrap" style="table-layout: fixed; width: 100%">
                            <thead>
                                <tr>
                                    <th style="width:8%;font-size:13px">รายการ</th>
                                    <th style="width:46%;font-size:13px">เทคโนโลยีที่มีอยู่ในปัจจุบัน</th>
                                    <th style="width:46%;font-size:13px">เทคโนโลยีในโครงการ</th>
                                <tr>
                            </thead>
                            <tbody>
                                @if ($fulltbp->fulltbpprojecttechdevlevel->count() > 0)
                                    @foreach ($fulltbp->fulltbpprojecttechdevlevel as $fulltbpprojecttechdevlevel)
                                        <tr>
                                            <td style="font-size:13px;line-height: 150%;word-wrap: break-word">{!!splitText($provider::FixBreak2($fulltbpprojecttechdevlevel->technology),20)!!}</td>
                                            <td style="font-size:13px;line-height: 150%;word-wrap: break-word">{!!splitText($provider::FixBreak2($fulltbpprojecttechdevlevel->presenttechnology),20)!!}</td>
                                            <td style="font-size:13px;line-height: 150%;word-wrap: break-word">{!!splitText($provider::FixBreak2($fulltbpprojecttechdevlevel->projecttechnology),20)!!}</td>
                                        </tr>   
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    

                    <div class="ml30 mt20" style="font-size:13px;page-break-inside: avoid;"><strong>อุปสรรค ความเสี่ยง และโอกาสในการพัฒนาด้านเทคโนโลยี : </strong>
                        <div style="margin-top:-15px;font-size:13px">{!!$provider::FixBreak($fulltbp->techdevproblem)!!}</div>
                    </div>

                    {{-- <div class="ml30" style="font-size:13px;margin-top:-10px">     --}}
                        <div style="font-size:13px;page-break-inside: avoid;">
                            {{-- <div class="ml30 mt20" style="font-size:13px"><strong>อุปสรรค ความเสี่ยง และโอกาสในการพัฒนาด้านเทคโนโลยี : </strong><span style="text-align: justify">{!!$provider::FixBreak($fulltbp->techdevproblem)!!}</span> </div> --}}
                            <div class="ml0 mt5" style="font-size:13px"><strong>2.6.2 การจัดการด้านทรัพย์สินทางปัญญา </strong></div>
                            <table class="mt5  tbwrap" >
                                <thead>
                                    <tr>
                                        <th style="width:35%;font-size:13px">สิทธิบัตรการประดิษฐ์</th>
                                        <th style="width:35%;font-size:13px">สิทธิบัตรการออกแบบ</th>
                                        <th style="width:30%;font-size:13px">อนุสิทธิบัตร</th>
                                    <tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-size:13px;padding-top:10px;border-bottom: none !important;">
                                            <div class="ml5 mt50" style="font-size:13px"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer1)) checked="checked" @endif > ได้รับการจดสิทธิบัตรการประดิษฐ์ @if ($fulltbp->fulltbpprojectcertify->cer1_qty > 0) <pre style="font-family: THSarabunNew">&emsp;(จำนวน: {{$fulltbp->fulltbpprojectcertify->cer1_qty}})</pre> @endif</div>
                                           
                                        </td>
                                        <td style="font-size:13px;border-bottom: none !important;">
                                            <div class="ml0 mt50" style="font-size:13px"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer3)) checked="checked" @endif> ได้รับการจดสิทธิบัตรการออกแบบ @if($fulltbp->fulltbpprojectcertify->cer3_qty>0) <pre style="font-family: THSarabunNew">&emsp;(จำนวน: {{$fulltbp->fulltbpprojectcertify->cer3_qty}})</pre>@endif  </div>
    
                                        </td>
                                        <td style="font-size:13px;border-bottom: none !important;">
                                            <div class="ml0 mt50" style="font-size:13px"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer5)) checked="checked" @endif> ได้รับการจดอนุสิทธิบัตร @if($fulltbp->fulltbpprojectcertify->cer5_qty>0) <pre style="font-family: THSarabunNew">&emsp;(จำนวน: {{$fulltbp->fulltbpprojectcertify->cer5_qty}})</pre>@endif </div>
                                           
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td style="font-size:13px;border-top: none !important;">
                                            <div class="ml0 mt50" style="font-size:13px"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer2)) checked="checked" @endif> ยื่นจดสิทธิบัตรการประดิษฐ์ @if($fulltbp->fulltbpprojectcertify->cer2_qty>0) <pre style="font-family: THSarabunNew">&emsp;(จำนวน: {{$fulltbp->fulltbpprojectcertify->cer2_qty}})</pre> @endif  </div>
                                        </td>
                                        <td style="font-size:13px;border-top: none !important;">
                                       
                                            <div class="ml0 mt50" style="font-size:13px"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer4)) checked="checked" @endif> ยื่นจดสิทธิบัตรการออกแบบ @if($fulltbp->fulltbpprojectcertify->cer4_qty>0) <pre style="font-family: THSarabunNew">&emsp;(จำนวน: {{$fulltbp->fulltbpprojectcertify->cer4_qty}})</pre> @endif  </div>
                                        </td>
                                        <td style="font-size:13px;border-top: none !important;">
                                           
                                            <div class="ml0 mt50" style="font-size:13px"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer6)) checked="checked" @endif> ยื่นจดอนุสิทธิบัตร @if($fulltbp->fulltbpprojectcertify->cer6_qty>0) <pre style="font-family: THSarabunNew">&emsp;(จำนวน: {{$fulltbp->fulltbpprojectcertify->cer6_qty}})</pre>@endif </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:13px;padding-top:10px;border-right: none !important;border-bottom: none !important;">
                                            <div class="ml0 mt50" style="font-size:13px"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer7)) checked="checked" @endif> ลิขสิทธิ์ @if($fulltbp->fulltbpprojectcertify->cer7_qty>0) (จำนวน: {{$fulltbp->fulltbpprojectcertify->cer7_qty}} )@endif</div>
                                            
                                        </td>
                                        <td colspan="2"  style="font-size:13px;padding-top:10px;border-left: none !important;border-bottom: none !important;">
                                            <div class="ml0 mt50" style="font-size:13px"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer8)) checked="checked" @endif> ความลับทางการค้า @if($fulltbp->fulltbpprojectcertify->cer8_qty > 0)  (จำนวน: {{$fulltbp->fulltbpprojectcertify->cer8_qty}} ) @endif</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:13px;border-right: none !important;border-top: none !important;border-bottom: none !important;">
                                            <div class="ml0 mt50" style="font-size:13px"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer9)) checked="checked" @endif> เครื่องหมายการค้า @if($fulltbp->fulltbpprojectcertify->cer9_qty>0) (จำนวน: {{$fulltbp->fulltbpprojectcertify->cer9_qty}} )@endif</div>
                                        </td>
                                        <td colspan="2"  style="font-size:13px;border-left: none !important;border-top: none !important;border-bottom: none !important;">
                                            <div class="ml0 mt50" style="font-size:13px"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer10)) checked="checked" @endif> ซื้อหรือต่อยอดทรัพย์สินทางปัญญา @if($fulltbp->fulltbpprojectcertify->cer10_qty>0) (จำนวน: {{$fulltbp->fulltbpprojectcertify->cer10_qty}} )@endif</div>
                                        </td>
                                    </tr >
                                    <tr>
                                        <td colspan="3" style="font-size:13px;border-top: none !important;">
                                            <div class="ml0 mt50" style="font-size:13px"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer11)) checked="checked" @endif> อื่นๆ เช่น สิ่งบ่งชี้ทางภูมิศาสตร์ (GI) ความหลากหลายทางพันธุ์พืช แบบผังภูมิของวงจรรวม @if($fulltbp->fulltbpprojectcertify->cer11_qty > 0) (จำนวน: {{$fulltbp->fulltbpprojectcertify->cer11_qty}} )@endif</div>
                                        </td>
                                    </tr>  
                                </tbody>
                            </table>
                        </div>

                    {{-- </div> --}}

                    <div class="ml30 mt20" style="font-size:13px;page-break-inside: avoid;"><strong>2.6.3 รางวัลทางด้านเทคโนโลยี / นวัตกรรม ที่ได้รับ</strong>
                        <div style="margin-top:-15px;font-size:13px">{!!$provider::FixBreak($fulltbp->innovation)!!}</div>
                    </div>

                    <div class="ml30 mt0" style="font-size:13px;page-break-inside: avoid;"><strong>2.6.4 ใบรับรองมาตรฐานต่างๆ ที่ได้รับ เช่น ISO, อย., มอก., GMP, HACCP, CMMI ฯลฯ </strong>
                        <div style="margin-top:-15px;font-size:13px">{!!$provider::FixBreak($fulltbp->standard)!!}</div>
                    </div>

                </div>

               
                    <div class="landscape" style="width:980px !important;">
                        <div class="ml20 mt20 " style="font-size:13px"><strong>2.7 แผนการดำเนินงานโครงการ (Gantt Chart) จำนวน {{$fulltbpgant->numofmonth}}  เดือน</strong></div>
                            <table class="mt5  border" style="width:100%">
                                <thead>
                                    <tr>
                                        <tr>
                                            <th rowspan="2" style="padding:5px">รายละเอียดการดำเนินงานของโครงการ</th> 
                                            @foreach ($allyears as $key => $item)
                                                @if ($item != 0)
                                                    <th colspan="{{$item}}" class="width:30px;max-width:30px !important;font-size:12px;padding:5px;text-align:center">{{$fulltbpgantt->startyear + $key}} </th> 
                                                @endif
                                            @endforeach
                                            {{-- <th rowspan="2" class="text-center hiddenelement" style="width: 140px">เพิ่มเติม</th>  --}}
                                        </tr>
                                        @if ($minmonth != 0 && $maxmonth !=0)
                                            <tr >
                                                @for ($i = $minmonth; $i <= $maxmonth; $i++)
                                                    <th class="text-center" style="width:30px;max-width:30px !important;font-size:12px;padding:5px;text-align:center">
                                                        @php
                                                            $full = 12;
                                                            if($i%12 == 0){
                                                                echo (12);
                                                            }else{
                                                                echo($i%12);
                                                            }
                                                        @endphp
                                                    </th>
                                                @endfor
                                            </tr>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="ganttchart_wrapper_tr">  
                                    @foreach ($fulltbpprojectplans as $key => $fulltbpprojectplan)
																				
                                    <tr id= "{{$fulltbpprojectplan->id}}" >                                        
                                        <td style="max-width:350px"> {{$fulltbpprojectplan->name}} <a href="#" data-toggle="modal" data-id="{{$fulltbpprojectplan->id}}" class="editprojectplan"><i class="icon-pencil5 text-info"></i></a> &nbsp;<a href="#" data-toggle="modal" data-id="{{$fulltbpprojectplan->id}}" class="deleteprojectplan"><i class="icon-trash text-danger"></i></a>
                                             </td> 
                                        @php
                                            $_count = 1;
                                        @endphp
                                        @for ($i = $minmonth; $i <= $maxmonth; $i++)
                                            @php
                                                $color = 'white';
                                                $check = $fulltbpprojectplan->fulltbpprojectplantransaction->where('month',$i)->first();
                                                if (!Empty($check)) {
                                                    $color = 'grey';
                                                }
                                            @endphp
                                                @php
                                                    $m = '';
                                                    $_c = $fulltbpprojectplan->planIndex($i);
                                                    if(!Empty($_c)){
                                                        $m = $_c ;
                                                    }
                                                @endphp
                                            <td style="background-color:{{$color}};width:30px;max-width:30px !important;font-size:12px;text-align:center">
                                                @if ($color == 'grey')
                                                {{$m}}
                                                @endif
                                            </td> 
                                            @php
                                                $_count++;
                                            @endphp
                                        @endfor															
                                    </tr>
                                @endforeach 
                                </tbody>
                            </table>
                    </div>
             
                <div class="portrait"></div>
                <div class="box bw650  mt20 " style="background-color: #bdd6ee;">
                    <div style="font-size:13px"><strong>3. ความเป็นไปได้ด้านการตลาดและแผนสู่เชิงพาณิชย์</strong></div>
                </div>
                <div class="box bw650  mt10" >
                    <div class="ml30 " style="font-size:13px"><strong>3.1 ข้อมูลด้านการตลาด</strong></div>
                    <div class="ml30" style="font-size:13px;page-break-inside: avoid;"><strong>Market analysis</strong>
                        <div style="margin-top:-15px;font-size:13px">{!!$provider::FixBreak($fulltbp->fulltbpmarketanalysis->detail)!!}</div>
                    </div>

                    <div class="ml30" style="font-size:13px;page-break-inside: avoid;"><strong>Business model canvas</strong>
                        <div style="margin-top:-15px;font-size:13px">{!!$provider::FixBreak($fulltbp->fulltbpmarketbusinessmodelcanvas->detail)!!}</div>
                    </div>

                    <div class="ml30" style="font-size:13px;page-break-inside: avoid;"><strong>วิเคราะห์ศักยภาพทางการค้า</strong>
                        <div style="margin-top:-15px;font-size:13px">{!!$provider::FixBreak($fulltbp->fulltbpmarketswot->detail)!!}</div>
                    </div>

                    {{-- <div class="ml50" style="font-size:13px">{!!$provider::FixBreak($fulltbp->fulltbpmarketanalysis->detail)!!}</div> --}}
                    {{-- <div class="ml50" style="font-size:13px;margin-top:-20px"><strong>Business model canvas</strong></div>
                    <div class="ml50" style="font-size:13px">{!!$provider::FixBreak($fulltbp->fulltbpmarketbusinessmodelcanvas->detail)!!}</div> --}}
                    {{-- <div class="ml50" style="font-size:13px"><strong>วิเคราะห์ศักยภาพทางการค้า</strong></div>
                    <div class="ml50" style="font-size:13px">{!!$provider::FixBreak($fulltbp->fulltbpmarketswot->detail)!!}</div> --}}
                    <div class="ml30" style="font-size:13px" ><strong>3.2 ข้อมูลยอดขายของบริษัท</strong></div>
                    <div style="font-size:13px">ข้อมูลยอดขายของแต่ละผลิตภัณฑ์ / บริการ (ยอดขาย 3 ปีย้อนหลัง) (หน่วย : บาท)</div>
                    <table class="mt5  border tbwrap" >
                        <thead>
                            <tr>
                                <th style="width:40%;font-size:13px">ยอดขายแยกตามประเภทผลิตภัณฑ์ / บริการ</th>
                                <th style="width:15%;font-size:13px">{{$fulltbp->past3}}</th> 
                                <th style="width:15%;font-size:13px">{{$fulltbp->past2}}</th> 
                                <th style="width:15%;font-size:13px">{{$fulltbp->past1}}</th>  
                                <th style="width:15%;font-size:13px">{{$fulltbp->past1 +1 }}</th>
                            <tr>
                        </thead>
                        <tbody>
                            @if ($fulltbp->fulltbpsell->count() > 0)
                                @foreach ($fulltbp->fulltbpsell as $fulltbpsell)
                                    <tr>
                                        <td style="font-size:13px">{!!splitText($provider::FixBreak2($fulltbpsell->name),25)!!}</td> 
                                        <td style="font-size:13px;text-align: right">{{number_format($fulltbpsell->past3,2)}}</td> 
                                        <td style="font-size:13px;text-align: right">{{number_format($fulltbpsell->past2,2)}}</td>  
                                        <td style="font-size:13px;text-align: right">{{number_format($fulltbpsell->past1,2)}} </td> 
                                        <td style="font-size:13px;text-align: right">{{number_format($fulltbpsell->present,2)}} </td>       
                                    </tr>   
                                @endforeach
                                <tr>
                                    <td class="center"><strong>รวมยอดขาย</strong> </td> 
                                    <td style="font-size:13px;text-align: right">{{number_format($fulltbp->fulltbpsell->sum('past3'),2)}}</td> 
                                    <td style="font-size:13px;text-align: right">{{number_format($fulltbp->fulltbpsell->sum('past2'),2)}}</td> 
                                    <td style="font-size:13px;text-align: right">{{number_format($fulltbp->fulltbpsell->sum('past1'),2)}} </td>   
                                    <td style="font-size:13px;text-align: right">{{number_format($fulltbp->fulltbpsell->sum('present'),2)}} </td>    
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="mt20" style="font-size:13px">(สถานะยอดขาย 3 ปีย้อนหลัง) (หน่วย : บาท)</div>
                    <table class="mt5  border tbwrap" >
                        <thead>
                            <tr>
                                <th style="width:40%;font-size:13px">ระยะเวลา</th>
                                <th style="width:15%;font-size:13px">{{$fulltbp->past3}}</th> 
                                <th style="width:15%;font-size:13px">{{$fulltbp->past2}}</th>   
                                <th style="width:15%;font-size:13px">{{$fulltbp->past1}}</th> 
                                <th style="width:15%;font-size:13px">{{$fulltbp->past1+1}}</th>   
                            <tr>
                        </thead>
                        <tbody>
                            @if ($fulltbp->fulltbpsellstatus->count() > 0)
                                @foreach ($fulltbp->fulltbpsellstatus as $fulltbpsellstatus)
                                    <tr>
                                        <td style="font-size:13px">{!!splitText($provider::FixBreak2($fulltbpsellstatus->name),30)!!}</td>
                                        <td style="font-size:13px;text-align: right">{{number_format($fulltbpsellstatus->past3,2)}}</td> 
                                        <td style="font-size:13px;text-align: right">{{number_format($fulltbpsellstatus->past2,2)}}</td> 
                                        <td style="font-size:13px;text-align: right">{{number_format($fulltbpsellstatus->past1,2)}} </td> 
                                        <td style="font-size:13px;text-align: right">{{number_format($fulltbpsellstatus->present,2)}} </td> 
                                    </tr>   
                                @endforeach
                                <tr>
                                    <td class="center"><strong>รวมยอดขาย</strong> </td> 
                                    <td style="font-size:13px;text-align: right">{{number_format($fulltbp->fulltbpsellstatus->sum('past3'),2)}}</td>
                                    <td style="font-size:13px;text-align: right">{{number_format($fulltbp->fulltbpsellstatus->sum('past2'),2)}}</td>  
                                    <td style="font-size:13px;text-align: right">{{number_format($fulltbp->fulltbpsellstatus->sum('past1'),2)}} </td> 
                                    <td style="font-size:13px;text-align: right">{{number_format($fulltbp->fulltbpsellstatus->sum('present'),2)}} </td> 
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div style="page-break-inside: avoid;">
                        <div class="mt20" style="font-size:13px">คู่ค้าหลักทางธุรกิจของโครงการ : ลูกหนี้การค้า (หน่วย : บาท)</div>
                        <table class="mt5  border tbwrap" >
                            <thead>
                                <tr>
                                    <th style="width:30%;font-size:12px">ชื่อคู่ค้าหลักของธุรกิจ</th>  
                                    <th style="width:15%;font-size:12px">จำนวนผลิตภัณฑ์<pre style="font-family: THSarabunNew">หรือโครงการ</pre></th> 
                                    <th style="width:15%;font-size:12px">เลขทะเบียน<pre style="font-family: THSarabunNew">นิติบุคคล</pre></th>                                                                                    
                                    <th style="width:10%;font-size:12px">ยอดขายต่อปี<pre style="font-family: THSarabunNew">(บาท)</pre></th>       
                                    <th style="width:15%;font-size:12px">เปรียบเทียบกับ<pre style="font-family: THSarabunNew">ยอดขาย (%)</pre></th>  
                                    <th style="width:15%;font-size:12px">จำนวนปีที่ทำ<pre style="font-family: THSarabunNew">ธุรกิจร่วมกัน (ปี)</pre></th> 
                                <tr>
                            </thead>
                            <tbody>
                                @if ($fulltbp->fulltbpdebtpartner->count() > 0)
                                    @foreach ($fulltbp->fulltbpdebtpartner as $fulltbpdebtpartner)
                                        <tr>
                                            <td style="font-size:13px">{!!splitText($provider::FixBreak2($fulltbpdebtpartner->debtpartner),20)!!}</td> 
                                            <td style="font-size:13px;text-align: right"> {{$fulltbpdebtpartner->numproject}} </td> 
                                            <td style="font-size:13px;text-align: right"> {{$fulltbpdebtpartner->partnertaxid}} </td> 
                                            <td style="font-size:13px;text-align: right">{{number_format($fulltbpdebtpartner->totalyearsell,2)}}</td>                                            															
                                            <td style="font-size:13px;text-align: right">{{number_format($fulltbpdebtpartner->percenttosale,2)}}</td> 
                                            <td style="font-size:13px;text-align: right">{{$fulltbpdebtpartner->businessyear}}</td> 
                                        </tr>   
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div style="page-break-inside: avoid;">
                        <div class="mt20" style="font-size:13px">คู่ค้าหลักทางธุรกิจของโครงการ : เจ้าหนี้การค้า (หน่วย : บาท)</div>
                        <table class="mt5  border tbwrap" >
                            <thead>
                                <tr>
                                    <th style="width:30%;font-size:12px">ชื่อคู่ค้าหลักของธุรกิจ</th>  
                                    <th style="width:15%;font-size:12px">เลขทะเบียน<pre style="font-family: THSarabunNew">นิติบุคคล</pre></th>                                                                                    
                                    <th style="width:15%;font-size:12px">ยอดซื้อต่อปี<pre style="font-family: THSarabunNew">(บาท)</pre></th>       
                                    <th style="width:15%;font-size:12px">เปรียบเทียบกับ<pre style="font-family: THSarabunNew">ยอดซื้อทั้งหมด (%)</pre></th>  
                                    <th style="width:15%;font-size:12px">จำนวนปีที่ทำ<pre style="font-family: THSarabunNew">ธุรกิจร่วมกัน (ปี)</pre></th> 
                                <tr>
                            </thead>
                            <tbody>
                                @if ($fulltbp->fulltbpcreditpartner->count() > 0)
                                    @foreach ($fulltbp->fulltbpcreditpartner as $fulltbpcreditpartner)
                                        <tr>
                                            <td style="font-size:13px">{!!splitText($provider::FixBreak2($fulltbpcreditpartner->creditpartner),30)!!}</td> 
                                            <td style="font-size:13px;text-align: right"> {{$fulltbpcreditpartner->partnertaxid}} </td> 
                                            <td style="font-size:13px;text-align: right">{{number_format($fulltbpcreditpartner->totalyearpurchase,2)}}</td>                                            															
                                            <td style="font-size:13px;text-align: right">{{number_format($fulltbpcreditpartner->percenttopurchase,2)}}</td> 
                                            <td style="font-size:13px;text-align: right">{{$fulltbpcreditpartner->businessyear}}</td> 
                                        </tr>   
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
                <div style="page-break-inside: avoid;">
                    <div class="box bw650  mt20 " style="background-color: #bdd6ee;">
                        <div style="font-size:13px"><strong>4. ข้อมูลทางด้านการเงิน</strong></div>
                    </div>
                    <div class="box bw650  mt10" style="page-break-inside: avoid;">
                        <div class="ml30 " style="font-size:13px"><strong>4.1 เงินลงทุนที่จำเป็นและการจัดหาแหล่งเงินลงทุนทั้งหมดของโครงการ</strong></div>
                        <div style="font-size:13px"><strong>เงินลงทุนในสินทรัพย์ถาวรของโครงการ</strong></div>
                        <table class="mt0  border tbwrap">
                            <thead>
                                <tr>
                                    <th style="width:22%;font-size:13px">รายการ</th>  
                                    <th style="width:17%;font-size:13px">จำนวนเงิน <pre style="font-family: THSarabunNew">(บาท)</pre></th>                                                                                    
                                    <th style="width:11%;font-size:13px">จำนวน<pre style="font-family: THSarabunNew">(หน่วย)</pre></th>       
                                    <th style="width:14%;font-size:13px">ราคาต่อหน่วย<pre style="font-family: THSarabunNew">(บาท)</pre></th>  
                                    <th style="width:35%;font-size:13px">ข้อมูลจำเพาะทางเทคนิค</th> 
                                <tr>
                            </thead>
                            <tbody>
                                @if ($fulltbp->fulltbpasset->count() > 0)
                                    @foreach ($fulltbp->fulltbpasset as $fulltbpasset)
                                        <tr>
                                            <td style="font-size:13px"> {!!splitText($provider::FixBreak2($fulltbpasset->asset),12)!!}</td> 
                                            <td style="font-size:13px;text-align: right;white-space: nowrap">{{number_format($fulltbpasset->cost,2)}}</td> 
                                            <td style="font-size:13px;text-align: right;white-space: nowrap"> {{$fulltbpasset->quantity}}</td>                                            															
                                            <td style="font-size:13px;text-align: right;white-space: nowrap">{{number_format($fulltbpasset->price,2)}}</td> 
                                            <td style="font-size:13px;line-height: 150%;">{!!splitText($provider::FixBreak2($fulltbpasset->specification),25)!!}</td> 
                                            {{--  --}}
                                        </tr>   
                                    @endforeach
                                    <tr>
                                        <td class="center"><strong>รวม</strong> </td> 
                                        <td style="font-size:13px;text-align: right;white-space: nowrap;margin-left:0px;margin-right:0px">{{number_format($fulltbp->fulltbpasset->sum('cost'),2)}} </td> 
                                        <td style="font-size:13px"> </td>                                            															
                                        <td style="font-size:13px;text-align: right;white-space: nowrap;margin-left:0px;margin-right:0px">{{number_format($fulltbp->fulltbpasset->sum('price'),2)}}</td> 
                                        <td style="font-size:13px"> </td> 
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box bw650  mt20" >
                    <div  class="mt10" style="font-size:13px;page-break-inside: avoid;"><strong>เงินลงทุนสำหรับดำเนินการของโครงการ</strong>
                        <table class="mt0  border tbwrap">
                            <thead>
                                <tr>
                                    <th style="width:75%;font-size:13px">รายการ </th>  
                                    <th style="width:25%;font-size:13px">จำนวนเงิน (บาท)</th>  
                                <tr>
                            </thead>
                            <tbody>
                                @if ($fulltbp->fulltbpinvestment->count() > 0)
                                    @foreach ($fulltbp->fulltbpinvestment as $fulltbpinvestment)
                                        <tr>
                                            <td style="font-size:13px"> {{$fulltbpinvestment->investment}}</td> 
                                            <td style="font-size:13px;text-align: right">{{number_format($fulltbpinvestment->cost,2)}}</td> 
                                        </tr>   
                                    @endforeach
                                    <tr>
                                        <td class="center" style="font-size:13px"><strong>รวม</strong> </td> 
                                        <td style="font-size:13px;text-align: right">{{number_format($fulltbp->fulltbpinvestment->sum('cost'),2)}} </td> 
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div  class="mt10" style="font-size:13px;page-break-inside: avoid;"><strong>แหล่งเงินทุนของโครงการ</strong>
                        <table class="mt0  border">
                            <thead>
                                <tr>
                                    <th style="width:26%;font-size:13px">รายการ</th>  
                                    <th style="width:16%;font-size:13px">เงินทุนที่มีอยู่แล้ว</th>                                                                                    
                                    <th style="width:16%;font-size:13px">เงินทุนที่เสนอ<pre style="font-family: THSarabunNew">ขออนุมัติ</pre> </th>   
                                    <th style="width:16%;font-size:13px">เงินทุนที่ได้รับ<pre style="font-family: THSarabunNew">การอนุมัติแล้ว</pre></th>   
                                    <th style="width:16%;font-size:13px">แผนการหา <pre style="font-family: THSarabunNew">เงินทุนเพิ่ม</pre></th>   
                                <tr>
                            </thead>
                            <tbody>
                                @if ($fulltbp->fulltbpcost->count() > 0)
                                    @foreach ($fulltbp->fulltbpcost as $fulltbpcost)
                                        <tr>
                                            <td style="font-size:13px"> {!!splitText($provider::FixBreak2($fulltbpcost->costname),20)!!}</td> 
                                            <td style="font-size:13px;text-align: right">{{number_format(intval($fulltbpcost->existing),2)}}</td> 
                                            <td style="font-size:13px;text-align: right">{{number_format(intval($fulltbpcost->need),2)}}</td> 
                                            <td style="font-size:13px;text-align: right">{{number_format(intval($fulltbpcost->approved),2)}}</td> 
                                            <td style="font-size:13px;text-align: right"> {{number_format(intval($fulltbpcost->plan),2)}}</td>
                                        </tr>   
                                    @endforeach
                                    <tr>
                                        <td class="center" style="font-size:13px"><strong>รวม</strong> </td> 
                                        <td style="font-size:13px;text-align: right">{{number_format($fulltbp->fulltbpcost->sum('existing'),2)}} </td> 
                                        <td style="font-size:13px;text-align: right">{{number_format($fulltbp->fulltbpcost->sum('need'),2)}} </td> 
                                        <td style="font-size:13px;text-align: right">{{number_format($fulltbp->fulltbpcost->sum('approved'),2)}} </td> 
                                        <td style="font-size:13px;text-align: right">{{number_format($fulltbp->fulltbpcost->sum('plan'),2)}} </td> 
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div style="page-break-inside: avoid;">
                        <div class="ml30 mt20" style="font-size:13px"><strong>4.2 ประมาณการผลตอบแทนจากการลงทุน </strong></div>
                        <div class="ml30" style="font-size:13px">- ประมาณการรายได้ที่จะเพิ่มขึ้น  {{number_format($fulltbp->fulltbpreturnofinvestment->income,2)}} บาท</div>
                        <div class="ml30" style="font-size:13px">- ประมาณการกำไรสุทธิที่จะเพิ่มขึ้น {{number_format($fulltbp->fulltbpreturnofinvestment->profit,2)}} บาท</div>
                        <div class="ml30" style="font-size:13px">- ประมาณการต้นทุนที่จะลดลง {{number_format($fulltbp->fulltbpreturnofinvestment->reduce,2)}} บาท</div>
                    </div>

                </div>
        </div>
        <div class="box ml30 mt20 " style="page-break-inside: avoid;width:680px">
            <div class="mt50" style="font-size:13px"><strong><u>หมายเหตุ</u> โปรดแนบเอกสารที่เกี่ยวข้องดังต่อไปนี้</strong></div>
            <div class="ml30" style="font-size:13px">1. สำเนาหนังสือรับรองจากการจดทะเบียนนิติบุคคล</div>
            <div class="ml30" style="font-size:13px">2. สำเนาบัญชีรายชื่อผู้ถือหุ้น (บอจ. 5)</div>
            <div class="ml30" style="font-size:13px">3. เอกสารอื่นๆ ที่เกี่ยวข้องกับโครงการ</div>

            <div style="page-break-inside: avoid;">
                <div class="box  mt30 " style="width:680px">
                    <div class="mt30" style="font-size:13px">
                        <p style="white-space: nowrap"><strong><u>ข้อตกลง:</u></strong> การลงลายมือชื่อข้างท้ายนี้ ผู้ขอรับการประเมินขอรับรองและยืนยันความถูกต้องของข้อมูลและรายละเอียดตามที่ระบุไว้
                        <br>ในแผนธุรกิจเทคโนโลยีฉบับนี้ หากภายหลังปรากฏเหตุอันเกิดข้อพิพาทที่เกี่ยวกับโครงการนี้ว่ามีการละเมิดทรัพย์สินทางปัญญาของ
                        <br>ผู้อื่นและหรือปลอมแปลงเอกสารของผู้อื่น หรือไม่ว่าประการใดก็ตาม ผู้ขอรับการประเมินจะเป็นผู้รับผิดชอบทั้งทางแพ่งและอาญา<br>แต่เพียงผู้เดียว</p>

                    </div>
                </div>
                <table class="bw500 ml50 mt50 center border">
                    <tr>
                        <td class="" style="text-align: center;width: 200px;color:grey;border: none;font-size:13px">(ประทับตราบริษัท – ถ้ามี)</td>
                        <td class="" style="text-align: right;width: 90px;border: none;"></td>
                        <td class="" style="text-align: right;width: 300px;border: none;">
                            @foreach ($fulltbpsignatures as $fulltbpsignature)
                              @php
                                   $directorposition = $fulltbpsignature->companyemploy->employposition->name;
                                   if($directorposition == 'อื่นๆ'){
                                        $directorposition = $fulltbpsignature->companyemploy->otherposition;
                                    }
                              @endphp
                              <table class="mt20">
                                <tr>
                                    <td class="" style="width:1px; text-align: right;border: none;font-size:13px">ลงชื่อ</td>
                                    <td class="" style="width: 200px;text-align: center;border: none;font-size:13px">
                                        @if ($fulltbp->signature_status_id == 2)
                                            <img src="{{asset($fulltbpsignature->companyemploy->signature->path)}}" alt="Girl in a jacket" width="100" height="40">
                                        @endif
                                    </td>
                                    <td class="" style="width: 1px;border: none;font-size:13px">ผู้ขอรับการประเมิน</td>
                                </tr>
                                <tr>
                                    <td class="" style="width: 1px; text-align: right;padding-top:15px;border: none;">(</td>
                                    <td class="" style="width: 200px;text-align: center;padding-top:15px;border: none;">
                                       @php
                                            $directorprefix = @$fulltbpsignature->companyemploy->prefix->name;
                                            if($directorprefix == 'อื่นๆ'){
                                                $directorprefix = @$fulltbpsignature->companyemploy->otherprefix;
                                            }
                                       @endphp
                                        {{$directorprefix}}{{$fulltbpsignature->companyemploy->name}} {{$fulltbpsignature->companyemploy->lastname}}
                                    </td>
                                    <td class="" style="width: 1px;text-align: left;padding-top:15px;border: none;">)</td>
                                </tr>
                                <tr>
                                    <td class="" style="width: 1px; text-align: right;border: none;"></td>
                                    <td class=" center" style="width: 200px;text-align: center;border: none;font-size:13px">{{$directorposition}}</td>
                                    <td class="" style="width: 1px;border: none;"></td>
                                </tr>
                            </table>
                            @endforeach
                        </td>
                    </tr>
                </table>
    
            </div>
        </div>
      

    </body>

</html>   

