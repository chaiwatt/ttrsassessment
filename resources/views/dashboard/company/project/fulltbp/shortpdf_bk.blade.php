@inject('provider', 'App\Http\Controllers\DashboardAdminEvaluationResultController')
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=1252">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>แผนธุรกิจเทคโนโลยี (ย่อ)</title>
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
                <div style="page-break-inside: avoid;">
                    <div class="box bw650  mt20 " style="background-color: #bdd6ee;">
                        <div style="font-size:13px"><strong>2. ภาพรวมโครงการที่ขอรับการประเมิน</strong></div>
                    </div>
                    <div class="ml30 mt20 "><strong>2.1 ชื่อโครงการ :</strong> {{$fulltbp->minitbp->project}}</div>
                </div>
                <div class="box bw650 " >
                    
                    <div class="ml30 mt0" style="font-size:13px"> <strong>2.2 ชื่อโครงการ (ภาษาอังกฤษ) :</strong> {{$fulltbp->minitbp->projecteng}}</div>
                    <div class="ml30 mt0" style="font-size:13px"> <strong>2.3 บทคัดย่อโครงการ :</strong> <span >{!!$provider::FixBreak($fulltbp->abtract)!!}</span></div>
                    <div class="ml30 mt0" style="font-size:13px"> <strong>2.4 ผลิตภัณฑ์หลัก สินค้า / บริการ ของโครงการ :</strong><span >{!!$provider::FixBreak($fulltbp->mainproduct)!!}</span></div>
                    <div class="ml30 mt0" style="font-size:13px"> <strong>2.5 จุดเด่นของผลิตภัณฑ์หลัก สินค้า / บริการ ของโครงการ :</strong>{!!$provider::FixBreak($fulltbp->productdetail)!!}</div>
                    <div class="ml30 mt0" style="font-size:13px"> <strong>2.6 ข้อมูลเทคโนโลยี
                        <div class="ml30 mt0" style="font-size:13px"> <strong>2.6.1 การพัฒนาเทคโนโลยี  :</strong> {!!$provider::FixBreak($fulltbp->techdev)!!}</div>
                        <div class="mt20" style="font-size:13px;page-break-inside: avoid;"><strong>ระดับของเทคโนโลยีและความใหม่ของผลิตภัณฑ์</strong>
                            <table class="mt5  border tbwrap" >
                                <thead>
                                    <tr>
                                        <th style="width:30%;font-size:13px">รายการ</th>
                                        <th style="width:35%;font-size:13px">เทคโนโลยีที่มีอยู่ในปัจจุบัน</th>
                                        <th style="width:35%;font-size:13px">เทคโนโลยีในโครงการ</th>
                                    <tr>
                                </thead>
                                <tbody>
                                    @if ($fulltbp->fulltbpprojecttechdevlevel->count() > 0)
                                        @foreach ($fulltbp->fulltbpprojecttechdevlevel as $fulltbpprojecttechdevlevel)
                                            <tr>
                                                <td style="font-size:13px">{{$fulltbpprojecttechdevlevel->technology}}</td>
                                                <td style="font-size:13px">{{$fulltbpprojecttechdevlevel->presenttechnology}}</td>
                                                <td style="font-size:13px">{{$fulltbpprojecttechdevlevel->projecttechnology}}</td>
                                            </tr>   
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>  
                        
                        <div style="font-size:13px;page-break-inside: avoid;">
                            <div class="ml30 mt20" style="font-size:13px"><strong>อุปสรรค ความเสี่ยง และโอกาสในการพัฒนาด้านเทคโนโลยี : </strong>{!!$provider::FixBreak($fulltbp->techdevproblem)!!}</div>
                            <div class="ml30 mt5" style="font-size:13px"><strong>2.6.2 การจัดการด้านทรัพย์สินทางปัญญา </strong></div>
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
                                            <div class="ml0 mt50" style="font-size:13px"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer9)) checked="checked" @endif> เครื่องหมายการค้า @if($fulltbp->fulltbpprojectcertify->cer9_qty>0) (จำนวน: {{$fulltbp->fulltbpprojectcertify->cer9_qty}} ) @endif</div>
                                        </td>
                                        <td colspan="2"  style="font-size:13px;border-left: none !important;border-top: none !important;border-bottom: none !important;">
                                            <div class="ml0 mt50" style="font-size:13px"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer10)) checked="checked" @endif> ซื้อหรือต่อยอดทรัพย์สินทางปัญญา @if($fulltbp->fulltbpprojectcertify->cer10_qty>0) (จำนวน: {{$fulltbp->fulltbpprojectcertify->cer10_qty}} ) @endif</div>
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
                        <div style="page-break-inside: avoid;">
                            <div class="ml30 mt20" style="font-size:13px"><strong>2.6.3 รางวัลทางด้านเทคโนโลยี / นวัตกรรมที่ได้รับ</strong></div>
                            <div class="ml30" style="font-size:13px">{!!$provider::FixBreak($fulltbp->innovation)!!}</div>
                        </div>

                        <div style="page-break-inside: avoid;">
                            <div class="ml30" style="font-size:13px"><strong>2.6.4 ใบรับรองมาตรฐานต่างๆ ที่ได้รับ เช่น ISO, อย., มอก., GMP, HACCP, CMMI ฯลฯ </strong></div>
                            <div class="ml30" style="font-size:13px">{!!$provider::FixBreak($fulltbp->standard)!!}</div>
                        </div>

                    </div>

                </div>
                <div class="landscape" style="width:980px">
                        <div class="ml20 mt20 " style="font-size:13px"><strong>2.7 แผนการดำเนินงานโครงการ (Gantt Chart) </strong></div>
                        <table class="mt5  border">
                            <thead>
                                <tr>
                                    <tr>
                                        <th rowspan="2" style="padding:5px">รายละเอียดการดำเนินงาน</th> 
                                        @foreach ($allyears as $key => $item)
                                            @if ($item != 0)
                                                <th colspan="{{$item}}" class="text-center">{{$fulltbpgantt->startyear + $key}} </th> 
                                            @endif
                                        @endforeach
                                        {{-- <th rowspan="2" class="text-center hiddenelement" style="width: 140px">เพิ่มเติม</th>  --}}
                                    </tr>
                                    @if ($minmonth != 0 && $maxmonth !=0)
                                        <tr >
                                            @for ($i = $minmonth; $i <= $maxmonth; $i++)
                                                <th class="text-center" style="width: 40px;font-size:10px;padding:5px">
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
                                @foreach ($fulltbpprojectplans as $fulltbpprojectplan)
                                
                                    <tr id= "{{$fulltbpprojectplan->id}}" >                                        
                                        <td> {{$fulltbpprojectplan->name}}</td> 
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
                                            <td style="background-color:{{$color}};width: 40px;font-size:9px;padding:5px;text-align:center">
                                                @if ($color == 'grey')
                                                 {{$_count}}
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
                <div class="box bw650  mt20" >
                    <div class="ml30 " style="font-size:13px"><strong>3.1 ข้อมูลด้านการตลาด</strong></div>
                    <div class="ml50" style="font-size:13px"><strong>Market analysis</strong></div>
                    <div class="ml50" style="font-size:13px">{!!$provider::FixBreak($fulltbp->fulltbpmarketanalysis->detail)!!}</div>
                    <div class="ml50" style="font-size:13px"><strong>Business model canvas</strong></div>
                    <div class="ml50" style="font-size:13px">{!!$provider::FixBreak($fulltbp->fulltbpmarketbusinessmodelcanvas->detail)!!}</div>
                    <div class="ml50" style="font-size:13px"><strong>วิเคราะห์ศักยภาพทางการค้า</strong></div>
                    <div class="ml50" style="font-size:13px">{!!$provider::FixBreak($fulltbp->fulltbpmarketswot->detail)!!}</div>
                    <div class="ml30" style="font-size:13px" ><strong>3.2 ข้อมูลยอดขายของบริษัท</strong></div>
                    <div style="font-size:13px">ข้อมูลยอดขายของแต่ละผลิตภัณฑ์ / บริการ (ยอดขาย 3 ปีย้อนหลัง) (หน่วย : บาท)</div>
                    @if ($fulltbp->fulltbpsell->count() > 0)
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
                            
                                @foreach ($fulltbp->fulltbpsell as $fulltbpsell)
                                    <tr>
                                        <td style="font-size:13px"> {{$fulltbpsell->name}}</td> 
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
                            
                        </tbody>
                    </table>
                    @endif
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
                                        <td style="font-size:13px">{!!$provider::FixBreak($fulltbpsellstatus->name)!!}</td>
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
                                    <th style="width:15%;font-size:12px">จำนวนปีที่ทำ<pre style="font-family: THSarabunNew">ธุรกิจร่วมกัน(ปี)</pre></th> 
                                <tr>
                            </thead>
                            <tbody>
                                @if ($fulltbp->fulltbpdebtpartner->count() > 0)
                                    @foreach ($fulltbp->fulltbpdebtpartner as $fulltbpdebtpartner)
                                        <tr>
                                            <td style="font-size:13px;"> {{$fulltbpdebtpartner->debtpartner}}</td> 
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
                                    <th style="width:20%;font-size:12px">เลขทะเบียน<pre style="font-family: THSarabunNew">นิติบุคคล</pre></th>                                                                                    
                                    <th style="width:20%;font-size:12px">ยอดซื้อต่อปี<pre style="font-family: THSarabunNew">(บาท)</pre></th>       
                                    <th style="width:15%;font-size:12px">เปรียบเทียบกับยอดซื้อ<pre style="font-family: THSarabunNew">(%)</pre></th>  
                                    <th style="width:15%;font-size:12px">จำนวนปีที่ทำ<pre style="font-family: THSarabunNew">ธุรกิจร่วมกัน(ปี)</pre></th> 
                                <tr>
                            </thead>
                            <tbody>
                                @if ($fulltbp->fulltbpcreditpartner->count() > 0)
                                    @foreach ($fulltbp->fulltbpcreditpartner as $fulltbpcreditpartner)
                                        <tr>
                                            <td style="font-size:13px;"> {{$fulltbpcreditpartner->creditpartner}}</td> 
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
        </div>
        <div class="box ml50 bw650  mt20 " style="page-break-inside: avoid;">
            <div class="mt50" style="font-size:13px"><strong><u>หมายเหตุ</u> โปรดแนบเอกสารที่เกี่ยวข้องดังต่อไปนี้</strong></div>
            <div class="ml30" style="font-size:13px">1. สำเนาหนังสือรับรองจากการจดทะเบียนนิติบุคคล</div>
            <div class="ml30" style="font-size:13px">2. สำเนาบัญชีรายชื่อผู้ถือหุ้น (บอจ. 5)</div>
            <div class="ml30" style="font-size:13px">3. เอกสารอื่นๆ ที่เกี่ยวข้องกับโครงการ</div>
        </div>
        <div style="page-break-inside: avoid;">
            <div class="box ml50 bw650  mt30 ">
                <div class="mt30" style="font-size:13px"><strong><u>ข้อตกลง :</u></strong>
                    {!!$provider::FixBreak("การลงลายมือชื่อข้างท้ายนี้ ผู้ขอรับการประเมินขอรับรองและยืนยันความถูกต้องของข้อมูลและรายละเอียดตามที่ระบุไว้ในแผนธุรกิจเทคโนโลยีฉบับนี้ หากภายหลังปรากฏเหตุอันเกิดข้อพิพาทที่เกี่ยวกับโครงการนี้ว่ามีการละเมิดทรัพย์สิน ทางปัญญาของผู้อื่นและหรือปลอมแปลงเอกสารของผู้อื่นหรือไม่ว่าประการใดก็ตามผู้ขอรับการประเมินจะเป็นผู้รับผิดชอบทั้งทางแพ่งและอาญาแต่เพียงผู้เดียว")!!}
                </div>
            </div>
            <table class="bw500 ml50 mt50 center border">
                <tr>
                    <td class="" style="text-align: center;width: 200px;color:grey;border: none;font-size:13px">(ประทับตราบริษัท – ถ้ามี)</td>
                    <td class="" style="text-align: right;width: 90px;border: none;"></td>
                    <td class="" style="text-align: right;width: 300px;border: none;">
                        @foreach ($fulltbpsignatures as $fulltbpsignature)
                          
                          <table class="mt20">
                            <tr>
                                <td class="" style="width:1px; text-align: right;border: none;font-size:13px">ลงชื่อ</td>
                                <td class="" style="width: 200px;text-align: center;border: none;font-size:13px">
                                    {{-- @if ($fulltbp->signature_status_id == 2)
                                        <img src="{{asset($fulltbpsignature->companyemploy->signature->path)}}" alt="Girl in a jacket" width="100" height="40">
                                    @endif --}}
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
                                <td class=" center" style="width: 200px;text-align: center;border: none;font-size:13px">เจ้าของหรือผู้บริหารระดับสูง</td>
                                <td class="" style="width: 1px;border: none;"></td>
                            </tr>
                        </table>
                        @endforeach
                    </td>
                </tr>
            </table>

        </div>

    </body>

</html>   


