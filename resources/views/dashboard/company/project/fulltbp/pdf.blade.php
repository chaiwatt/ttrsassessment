@inject('provider', 'App\Http\Controllers\DashboardAdminEvaluationResultController')
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=1252">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Report</title>
        <link href="{{asset('assets/dashboard/css/pdf.css')}}" rel="stylesheet" type="text/css">
        <style>
            @page {
            footer: page-footer;
        }
        </style>
    </head>
    <body>

        <div class="wrapper">
            <htmlpagefooter name="page-footer">
                <div class="font12 right" alt="">F-CO-TTRS-02 rev0&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<strong>เอกสารสำคัญปกปิด(Private & Confidential)</strong>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;{PAGENO}/{nb}</div>
             </htmlpagefooter>
            <div class="container" >
                <div class="box"  >
                    <img src="{{asset('assets/dashboard/images/ttrs.png')}}" style="width:120px" alt="">
                    <img src="{{asset('assets/dashboard/images/nstda.png')}}" style="width:130px;margin-right:20px" class="right" alt="">
                </div>

                <div class="box bw600 border mt20 ml30 center">
                    <div ><strong>แผนธุรกิจเทคโนโลยี</strong></div>
                    <div ><strong>(Technology Business Plan: TBP)</strong></div>
                    <div class="mt20 mb20"><strong>ชื่อโครงการ</strong></div>
                    <div class="mb10"><strong>{{$fulltbp->minitbp->project}} @if (!Empty($fulltbp->minitbp->projecteng)) ({{$fulltbp->minitbp->projecteng}})@endif</strong></div>
                </div>
                <div class="box center mt20">
                    <div ><strong>(PRIVATE & CONFIDENTIAL)</strong></div>
                    <div ><strong>เสนอ</strong></div>
                    <div ><strong>สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)</strong></div>
                    <div class="mt20"><strong>โดย</strong></div>
                    <div class="mt20"><strong>{{$fulltbp->minitbp->businessplan->company->name}}</strong></div>
                </div>
                <div class="box mt40 ml80">
                    <div><strong>ชื่อผู้เสนอโครงการ/ผู้ประสานงาน : {{$fulltbp->minitbp->contactpersonprefix->name}}{{$fulltbp->minitbp->contactname}}  {{$fulltbp->minitbp->contactlastname}}</strong></div>
                    <div>ตำแหน่ง : {{$fulltbp->minitbp->contactposition}}</div>
                    <div>โทรศัพท์ : {{$fulltbp->minitbp->contactphone}}</div>
                    <div>อีเมล : {{$fulltbp->minitbp->contactemail}}</div>
                    <div>เว็บไซต์ : {{$fulltbp->minitbp->website}}</div>
                </div>
                <div class="box center mt20 mb20 ">
                    <div><strong>แผนธุรกิจเทคโนโลยีเพื่อเข้ารับการประเมินโดย TTRS Model</strong></div>
                </div>
                <div class="box bw650 font14 border" style="background-color: #daedf3;">
                    <div class="mt5 ml5"><u><strong>วิธียื่นแผนธุรกิจเทคโนโลยีเพื่อเข้ารับการประเมินฯ</strong></u></div>
                        <div class="ml5">• ผู้ที่ประสงค์จะยื่นแผนธุรกิจเทคโนโลยีจะต้องกรอกข้อมูลในแบบฟอร์ม และยื่นเอกสารต่อสำนักงานพัฒนา<br>วิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)</div>
                        <div class="ml5">• กรุณาศึกษาข้อแนะนำอย่างละเอียดก่อนที่จะกรอกข้อมูลในแบบฟอร์มแผนธุรกิจเทคโนโลยี </div>
                        <div class="ml5">• กรุณาตรวจสอบและแนบเอกสารที่เกี่ยวข้องประกอบการยื่นแผนธุรกิจเทคโนโลยีให้ครบถ้วน</div> 
                        <div class="ml5">• หากมีข้อสงสัยหรือต้องการข้อมูลเพิ่มเติม โปรดติดต่อศูนย์สนับสนุนและให้บริการประเมินจัดอันดับเทคโนโลยี<br>สวทช. E-mail: ttrs@nstda.or.th
                    </div>
                </div>
                <div class="page-break"></div>
                <div class="box bw650 font14 mt20 " style="background-color: #bdd6ee;">
                    <div ><strong>1. ข้อมูลทั่วไป</strong></div>
                </div>
                <div class="box bw650 font14 mt20" >
                    <div class="ml20 mt-10">1.1 ชื่อนิติบุคคล : {{$fulltbp->minitbp->businessplan->company->name}} </div>
                    <div class="ml20 mt0">1.2 เลขทะเบียนนิติบุคคล : {{$fulltbp->minitbp->businessplan->company->vatno}} </div> 
                    <div class="ml20 mt0">1.3 ปีที่จดทะเบียน : พ.ศ. {{$fulltbp->minitbp->businessplan->company->registeredyear}} </div>
                    <div class="ml20 mt0">1.4 ทุนจดทะเบียน : {{number_format($fulltbp->minitbp->businessplan->company->registeredcapital,2)}} บาท</div>
                    <div class="ml20 mt0">1.5 ทุนจดทะเบียนที่เรียกชำระแล้ว: : {{number_format($fulltbp->minitbp->businessplan->company->paidupcapital,2)}} บาท เมื่อวันที่:	{{$fulltbp->minitbp->businessplan->company->paidupcapitaldate}}	</div>
                    <div class="ml20 mt0">1.6 แผนผังองค์กร (Organization Chart)	
                        <div class="box bw500 bh300 border borderdotted mt5 ml70 mb20 center">
                            <img src="{{asset($fulltbp->minitbp->businessplan->company->organizeimg)}}" class="bw500 bh300" alt="">
                        </div>
                    </div>
                    <div class="ml20 mt0">1.7 จำนวนบุคลากรทั้งหมด&emsp;{{$fulltbp->fulltbpemployee->department_qty}}&emsp;คน
                        <div class="ml50 mt0">- ฝ่ายบริหาร&emsp;{{$fulltbp->fulltbpemployee->department1_qty}}&emsp;คน</div>
                        <div class="ml50 mt0">- ฝ่ายวิจัยและพัฒนา&emsp;{{$fulltbp->fulltbpemployee->department2_qty}}&emsp;คน</div>
                        <div class="ml50 mt0">- ฝ่ายผลิต/วิศวกรรม&emsp;{{$fulltbp->fulltbpemployee->department3_qty}}&emsp;คน</div>
                        <div class="ml50 mt0">- ฝ่ายการตลาด&emsp;{{$fulltbp->fulltbpemployee->department4_qty}}&emsp;คน</div>
                        <div class="ml50 mt0">- พนักงานทั่วไป&emsp;{{$fulltbp->fulltbpemployee->department5_qty}}&emsp;คน</div>
                    </div>
                    <div class="ml20 mt0"><strong>1.8 ประเภทของธุรกิจ</strong>
                        <div class="ml50 mt0"><strong>1.8.1 ธุรกิจนิติบุคคล</strong>{{$fulltbp->minitbp->businessplan->company->business_type_id}}
                            <div class="ml50 mt0"><input type="checkbox" @if ($fulltbp->minitbp->businessplan->company->business_type_id == 3) checked="checked" @endif > ห้างหุ้นส่วนจำกัด</div>
                            <div class="ml50 mt0"><input type="checkbox" @if ($fulltbp->minitbp->businessplan->company->business_type_id == 2) checked="checked" @endif > บริษัทจำกัด</div>
                            <div class="ml50 mt0"><input type="checkbox" @if ($fulltbp->minitbp->businessplan->company->business_type_id == 1) checked="checked" @endif > บริษัทมหาชนจำกัด</div>
                            <div class="ml50 mt0"><input type="checkbox" @if ($fulltbp->minitbp->businessplan->company->business_type_id == 6) checked="checked" @endif > องค์กรธุรกิจจัดตั้ง หรือจดทะเบียนภายใต้กฎหมายเฉพาะ</div>
                        </div>
                        <div class="ml50 mt0"><strong>1.8.2 ธุรกิจที่ไม่เป็นนิติบุคคล</strong>
                            <div class="ml50 mt0"><input type="checkbox" @if ($fulltbp->minitbp->businessplan->company->business_type_id == 5) checked="checked" @endif > กิจการเจ้าของคนเดียว</div>
                            <div class="ml50 mt0"><input type="checkbox" @if ($fulltbp->minitbp->businessplan->company->business_type_id == 4) checked="checked" @endif > การจัดตั้งห้างหุ้นส่วนสามัญ</div>
                        </div>
                    </div>
                    <div class="page-break"></div>
                    <div class="ml20 mt0"><strong>1.9 ประวัติของบริษัท (Company Profile)</strong>
                        <div>{!!$provider::FixBreak($fulltbp->minitbp->businessplan->company->companyhistory)!!}</div>
                    </div>
                    <div class="ml20 mt20"><strong>1.10 ข้อมูลผู้บริหารระดับสูง (CEO หรือ กรรมการผู้จัดการ)</strong>
                        <div class="ml30 mt0">ชื่อ-นามสกุล : {{$fulltbp->companyemploy->prefix->name}}{{$fulltbp->companyemploy->name}} {{$fulltbp->companyemploy->lastname}}</div>
                        <div class="ml30 mt0">ตำแหน่ง : {{$fulltbp->companyemploy->employposition->name}}</div>
                        <div class="ml30 mt0">โทรศัพท์ : {{$fulltbp->companyemploy->workphone}}</div>
                        <div class="ml30 mt0">โทรศัพท์มือถือ : {{$fulltbp->companyemploy->phone}}</div>
                        <div class="ml30 mt0">อีเมล : {{$fulltbp->companyemploy->email}}</div>
                        @if ($fulltbp->employeducation->count() > 0)
                            <div class="ml30 mt10"><strong>ประวัติการศึกษา</strong>
                                <table class="mt5 font14 border tbwrap" >
                                    <thead>
                                        <tr>
                                            <th style="width:25%">ระดับ</th>
                                            <th style="width:35%">ชื่อสถานศึกษา</th>
                                            <th style="width:20%">สาขาวิชาเอก</th>
                                            <th style="width:20%">ปีที่ศึกษา<pre>(เริ่มต้น-สิ้นสุด)</pre></th>
                                        <tr>
                                    </thead>
                                    <tbody>
                                        @if ($fulltbp->employeducation->count() > 0)
                                            @foreach ($fulltbp->employeducation as $employeducation)
                                                <tr>
                                                    <td>{{$employeducation->employeducationlevel}}</td>
                                                    <td>{{$employeducation->employeducationinstitute}}</td>
                                                    <td>{!!$provider::FixBreak($employeducation->employeducationmajor)!!}</td>
                                                    <td>{{$employeducation->employeducationyear}}</td>
                                                </tr>   
                                            @endforeach   
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        @if ($fulltbp->employexperience->count() > 0)
                            <div class="ml30 mt20"><strong>ประวัติการทำงาน</strong>
                                <table class="mt5 font14 tbwrap" >
                                    <thead>
                                        <tr>
                                            <th >เริ่มต้น</th>
                                            <th >สิ้นสุด</th>
                                            <th >บริษัท</th>
                                            <th >ประเภทธุรกิจ</th>
                                            <th style="width:20%">ตำแหน่งแรกเข้า</th>
                                            <th style="width:20%">ตำแหน่งล่าสุด</th>
                                        <tr>
                                    </thead>
                                    <tbody>
                                        @if ($fulltbp->employexperience->count() > 0)
                                            @foreach ($fulltbp->employexperience as $employexperience)
                                                <tr>
                                                    <td>{{$employexperience->startdate}}</td>
                                                    <td>{{$employexperience->enddate}}</td>
                                                    <td>{{$employexperience->company}}</td>
                                                    <td>{{$employexperience->businesstype}}</td>
                                                    <td>{{$employexperience->startposition}}</td>
                                                    <td>{{$employexperience->endposition}}</td>
                                                </tr>   
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div> 
                        @endif
                        @if ($fulltbp->employtraining->count() > 0)
                            <div class="ml30 mt20"><strong>ประวัติการฝึกอบรม</strong>
                                <table class="mt5 font14 border tbwrap" >
                                    <thead>
                                        <tr>
                                            <th style="width:25%">วัน เดือน ปี</th>
                                            <th >หลักสูตร</th>
                                            <th style="width:40%">หน่วยงานผู้จัด</th>
                                        <tr>
                                    </thead>
                                    <tbody>
                                        @if ($fulltbp->employtraining->count() > 0)
                                            @foreach ($fulltbp->employtraining as $employtraining)
                                                <tr>
                                                    <td>{{$employtraining->trainingdate}}</td>
                                                    <td>{{$employtraining->course}}</td>
                                                    <td>{{$employtraining->owner}}</td>
                                                </tr>   
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>  
                        @endif
                    </div>
                    <div class="ml20 mt20"><strong>1.11 ข้อมูลทีมบริหาร (CTO, CFO, COO, และ CMO)</strong>
                        @if ($companyboards->count() > 0)
                            @foreach ($companyboards as $key => $companyemboard)
                                @if ($companyboards->count() > 1)
                                    <div class="ml30 mt10"><strong><u>ลำดับที่ {{$key +1}}</u></strong></div>
                                @endif
                                <div class="ml30 mt0">ชื่อ-นามสกุล : {{$companyemboard->prefix->name}}{{$companyemboard->name}} {{$companyemboard->lastname}}</div>
                                <div class="ml30 mt0">ตำแหน่ง : {{$companyemboard->employposition->name}}</div>
                                <div class="ml30 mt0">โทรศัพท์ : {{$companyemboard->workphone}}</div>
                                <div class="ml30 mt0">โทรศัพท์มือถือ : {{$companyemboard->phone}}</div>
                                <div class="ml30 mt0">อีเมล : {{$companyemboard->email}}</div>

                                @if ($companyemboard->employeducation->count() > 0)
                                    <div class="ml30 mt20"><strong>ประวัติการศึกษา</strong>
                                        <table class="mt5 font14 border tbwrap" >
                                            <thead>
                                                <tr>
                                                    <th style="width:25%">ระดับ</th>
                                                    <th style="width:35%">ชื่อสถานศึกษา</th>
                                                    <th style="width:20%">สาขาวิชาเอก</th>
                                                    <th style="width:20%">ปีที่ศึกษา<pre>(เริ่มต้น-สิ้นสุด)</pre></th>
                                                <tr>
                                            </thead>
                                            <tbody>
                                                @if ($companyemboard->employeducation->count() > 0)
                                                    @foreach ($companyemboard->employeducation as $employeducation)
                                                        <tr>
                                                            <td>{{$employeducation->employeducationlevel}}</td>
                                                            <td>{{$employeducation->employeducationinstitute}}</td>
                                                            <td>{!!$provider::FixBreak($employeducation->employeducationmajor)!!}</td>
                                                            <td>{{$employeducation->employeducationyear}}</td>
                                                        </tr>   
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if ($companyemboard->employexperience->count() > 0)
                                    <div class="ml30 mt20"><strong>ประวัติการทำงาน</strong>
                                        <table class="mt5 font14 tbwrap" >
                                            <thead>
                                                <tr>
                                                    <th >เริ่มต้น</th>
                                                    <th >สิ้นสุด</th>
                                                    <th >บริษัท</th>
                                                    <th >ประเภทธุรกิจ</th>
                                                    <th style="width:20%">ตำแหน่งแรกเข้า</th>
                                                    <th style="width:20%">ตำแหน่งล่าสุด</th>
                                                <tr>
                                            </thead>
                                            <tbody>
                                                @if ($companyemboard->employexperience->count() > 0)
                                                    @foreach ($companyemboard->employexperience as $employexperience)
                                                        <tr>
                                                            <td>{{$employexperience->startdate}}</td>
                                                            <td>{{$employexperience->enddate}}</td>
                                                            <td>{{$employexperience->company}}</td>
                                                            <td>{{$employexperience->businesstype}}</td>
                                                            <td>{{$employexperience->startposition}}</td>
                                                            <td>{{$employexperience->endposition}}</td>
                                                        </tr>   
                                                    @endforeach 
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if ($companyemboard->employtraining->count() > 0)
                                    <div class="ml30 mt20"><strong>ประวัติการฝึกอบรม</strong>
                                        <table class="mt5 font14 border tbwrap" >
                                            <thead>
                                                <tr>
                                                    <th style="width:25%">วัน เดือน ปี</th>
                                                    <th >หลักสูตร</th>
                                                    <th style="width:20%">หน่วยงานผู้จัด</th>
                                                <tr>
                                            </thead>
                                            <tbody>
                                                @if ($companyemboard->employtraining->count() > 0)
                                                    @foreach ($companyemboard->employtraining as $employtraining)
                                                        <tr>
                                                            <td>{{$employtraining->trainingdate}}</td>
                                                            <td>{{$employtraining->course}}</td>
                                                            <td>{{$employtraining->owner}}</td>
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
                    <div class="ml20 mt20"><strong>1.12 บัญชีรายชื่อผู้ถือหุ้น</strong>
                        <table class="ml30 mt5 font14 tbwrap" >
                            <thead>
                                <tr>
                                    <th style="width:50%">รายชื่อผู้ถือหุ้น</th>
                                    <th style="width:50%">ความสัมพันธ์ CEO</th>
                                <tr>
                            </thead>
                            <tbody>
                                @if ($companystockholders->count() > 0)
                                    @foreach ($companystockholders as $key => $companystockholder)
                                        <tr>
                                            <td>{{$companystockholder->companyemploy->prefix->name}}{{$companystockholder->companyemploy->name}} {{$companystockholder->companyemploy->lastname}}</td>
                                            <td>{{$companystockholder->relationwithceo}}</td>
                                        </tr>   
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="ml20 mt20"><strong>1.13 ข้อมูลพนักงานด้านการวิจัย พัฒนา การผลิต และวิศวกรรม </strong>
                        @if ($companyemploys->count() > 0)
                            @foreach ($companyemploys as $key => $companyemploy)
                                @if ($companyemploys->count() > 1)
                                    <div class="ml30 mt10"><strong><u>ลำดับที่ {{$key +1}}</u></strong></div>
                                @endif
                                <div class="ml30 mt0">ชื่อ-นามสกุล : {{$companyemploy->prefix->name}}{{$companyemploy->name}} {{$companyemploy->lastname}}</div>
                                <div class="ml30 mt0">ตำแหน่ง : {{$companyemploy->employposition->name}}</div>
                                <div class="ml30 mt0">โทรศัพท์ : {{$companyemploy->workphone}}</div>
                                <div class="ml30 mt0">โทรศัพท์มือถือ : {{$companyemploy->phone}}</div>
                                <div class="ml30 mt0">อีเมล : {{$companyemploy->email}}</div>

                                @if ($companyemploy->employeducation->count() > 0)
                                    <div class="ml30 mt20"><strong>ประวัติการศึกษา</strong>
                                        <table class="mt5 font14 border tbwrap" >
                                            <thead>
                                                <tr>
                                                    <th style="width:25%">ระดับ</th>
                                                    <th style="width:35%">ชื่อสถานศึกษา</th>
                                                    <th style="width:20%">สาขาวิชาเอก</th>
                                                    <th style="width:20%">ปีที่ศึกษา<pre>(เริ่มต้น-สิ้นสุด)</pre></th>
                                                <tr>
                                            </thead>
                                            <tbody>
                                                @if ($companyemploy->employeducation->count() > 0)
                                                    @foreach ($companyemploy->employeducation as $employeducation)
                                                        <tr>
                                                            <td>{{$employeducation->employeducationlevel}}</td>
                                                            <td>{{$employeducation->employeducationinstitute}}</td>
                                                            <td>{!!$provider::FixBreak($employeducation->employeducationmajor)!!}</td>
                                                            <td>{{$employeducation->employeducationyear}}</td>
                                                        </tr>   
                                                    @endforeach
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if ($companyemploy->employexperience->count() > 0)
                                    <div class="ml30 mt20"><strong>ประวัติการทำงาน</strong>
                                        <table class="mt5 font14 tbwrap" >
                                            <thead>
                                                <tr>
                                                    <th >เริ่มต้น</th>
                                                    <th >สิ้นสุด</th>
                                                    <th >บริษัท</th>
                                                    <th >ประเภทธุรกิจ</th>
                                                    <th style="width:20%">ตำแหน่งแรกเข้า</th>
                                                    <th style="width:20%">ตำแหน่งล่าสุด</th>
                                                <tr>
                                            </thead>
                                            <tbody>
                                                @if ($companyemploy->employexperience->count() > 0)
                                                    @foreach ($companyemploy->employexperience as $employexperience)
                                                        <tr>
                                                            <td>{{$employexperience->startdate}}</td>
                                                            <td>{{$employexperience->enddate}}</td>
                                                            <td>{!!$provider::FixBreak($employexperience->company)!!}</td>
                                                            <td>{{$employexperience->businesstype}}</td>
                                                            <td>{{$employexperience->startposition}}</td>
                                                            <td>{{$employexperience->endposition}}</td>
                                                        </tr>   
                                                    @endforeach  
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if ($companyemploy->employtraining->count() > 0)
                                    <div class="ml30 mt20"><strong>ประวัติการฝึกอบรม</strong>
                                        <table class="mt5 font14 border tbwrap" >
                                            <thead>
                                                <tr>
                                                    <th style="width:25%">วัน เดือน ปี</th>
                                                    <th >หลักสูตร</th>
                                                    <th style="width:20%">หน่วยงานผู้จัด</th>
                                                <tr>
                                            </thead>
                                            <tbody>
                                                @if ($companyemploy->employtraining->count() > 0)
                                                    @foreach ($companyemploy->employtraining as $employtraining)
                                                        <tr>
                                                            <td>{{$employtraining->trainingdate}}</td>
                                                            <td>{{$employtraining->course}}</td>
                                                            <td>{{$employtraining->owner}}</td>
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

                    <div class="ml20 mt20"><strong>1.14 ข้อมูลผู้รับผิดชอบหลักในโครงการ (ผู้จัดการโครงการ/หัวหน้าโครงการ)</strong>
                        <div class="ml30 mt0">ชื่อ-นามสกุล : {{$fulltbp->fulltbpresponsibleperson->prefix->name}}{{$fulltbp->fulltbpresponsibleperson->name}} {{$fulltbp->fulltbpresponsibleperson->lastname}}</div>
                        <div class="ml30 mt0">ตำแหน่ง : {{$fulltbp->fulltbpresponsibleperson->position}}</div>
                        <div class="ml30 mt0">โทรศัพท์ : {{$fulltbp->fulltbpresponsibleperson->phone1}}</div>
                        <div class="ml30 mt0">โทรศัพท์มือถือ : {{$fulltbp->fulltbpresponsibleperson->phone2}}</div>
                        <div class="ml30 mt0">อีเมล : {{$fulltbp->fulltbpresponsibleperson->email}}</div>
                    </div>
                </div>
                <div class="box bw650 font14 mt20 " style="background-color: #bdd6ee;">
                    <div ><strong>2. ภาพรวมโครงการที่ขอรับการประเมิน</strong></div>
                </div>
                <div class="box bw650 font14 mt20" >
                    <div class="ml30 mt-10"><strong>2.1 ชื่อโครงการ :</strong> {{$fulltbp->minitbp->project}}</div>
                    <div class="ml30 mt0"><strong>2.2 ชื่อโครงการ (ภาษาอังกฤษ) :</strong> {{$fulltbp->minitbp->projecteng}}</div>
                    <div class="ml30 mt0"><strong>2.3 บทคัดย่อโครงการ :</strong> <span >{!!$provider::FixBreak($fulltbp->abtract)!!}</span></div>
                    <div class="ml30 mt0"><strong>2.4 ผลิตภัณฑ์หลัก (สินค้า/บริการ) ของโครงการ :</strong><span >{!!$provider::FixBreak($fulltbp->mainproduct)!!}</span></div>
                    <div class="ml30 mt0"><strong>2.5 จุดเด่นของผลิตภัณฑ์หลัก (สินค้า/บริการ) ของโครงการ :</strong>{!!$provider::FixBreak($fulltbp->productdetail)!!}</div>
                    <div class="ml30 mt0"><strong>2.6 ข้อมูลเทคโนโลยี
                        <div class="ml30 mt0"><strong>2.6.1 การพัฒนาเทคโนโลยี  :</strong> {!!$provider::FixBreak($fulltbp->techdev)!!}</div>
                        <div class="mt20"><strong>ระดับของเทคโนโลยีและความใหม่ของผลิตภัณฑ์</strong>
                            <table class="mt5 font14 border tbwrap" >
                                <thead>
                                    <tr>
                                        <th style="width:30%">รายการ</th>
                                        <th style="width:35%">เทคโนโลยีที่มีอยู่ในปัจจุบัน</th>
                                        <th style="width:35%">เทคโนโลยีในโครงการ</th>
                                    <tr>
                                </thead>
                                <tbody>
                                    @if ($fulltbp->fulltbpprojecttechdevlevel->count() > 0)
                                        @foreach ($fulltbp->fulltbpprojecttechdevlevel as $fulltbpprojecttechdevlevel)
                                            <tr>
                                                <td>{{$fulltbpprojecttechdevlevel->technology}}</td>
                                                <td>{{$fulltbpprojecttechdevlevel->presenttechnology}}</td>
                                                <td>{{$fulltbpprojecttechdevlevel->projecttechnology}}</td>
                                            </tr>   
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>  
                        <div class="ml30 mt20"><strong>อุปสรรค ความเสี่ยง และโอกาสในการพัฒนาด้านเทคโนโลยี : </strong>{!!$provider::FixBreak($fulltbp->techdevproblem)!!}</div>
                        <div class="ml30 mt5"><strong>2.6.2 การจัดการด้านทรัพย์สินทางปัญญา </strong></div>
                        <table class="mt5 font14 tbwrap" >
                            <thead>
                                <tr>
                                    <th style="width:35%">สิทธิบัตรการประดิษฐ์</th>
                                    <th style="width:35%">สิทธิบัตรการออกแบบ</th>
                                    <th style="width:30%">อนุสิทธิบัตร</th>
                                <tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="ml0 mt50"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer1)) checked="checked" @endif >ได้รับการจดสิทธิบัตรการประดิษฐ์ <pre>(จำนวน: {{$fulltbp->fulltbpprojectcertify->cer1_qty}})</pre></div>
                                        <br>
                                        <div class="ml0 mt50"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer2)) checked="checked" @endif>ยื่นจดสิทธิบัตรการประดิษฐ์ <pre>(จำนวน: {{$fulltbp->fulltbpprojectcertify->cer2_qty}})</pre> </div>
                                    </td>
                                    <td>
                                        <div class="ml0 mt50"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer3)) checked="checked" @endif>ได้รับการจดสิทธิบัตรการออกแบบ <pre>(จำนวน: {{$fulltbp->fulltbpprojectcertify->cer3_qty}})</pre> </div>
                                        <br>
                                        <div class="ml0 mt50"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer4)) checked="checked" @endif>ยื่นจดสิทธิบัตรการออกแบบ <pre>(จำนวน: {{$fulltbp->fulltbpprojectcertify->cer4_qty}})</pre> </div>
                                    </td>
                                    <td>
                                        <div class="ml0 mt50"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer5)) checked="checked" @endif>ได้รับการจดอนุสิทธิบัตร <pre>(จำนวน: {{$fulltbp->fulltbpprojectcertify->cer5_qty}})</pre></div>
                                        <br>
                                        <div class="ml0 mt50"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer6)) checked="checked" @endif>ยื่นจดอนุสิทธิบัตร (จำนวน: {{$fulltbp->fulltbpprojectcertify->cer6_qty}})</div>
                                    </td>
                                </tr> 
                                <tr>
                                    <td colspan="3">
                                        <div class="ml0 mt50"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer7)) checked="checked" @endif>ลิขสิทธิ์ (จำนวน: {{$fulltbp->fulltbpprojectcertify->cer7_qty}} )&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer9)) checked="checked" @endif>ความลับทางการค้า (จำนวน:  )</div>
                                        <br>
                                        <div class="ml0 mt50"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer8)) checked="checked" @endif>เครื่องหมายการค้า (จำนวน: {{$fulltbp->fulltbpprojectcertify->cer8_qty}} )&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer10)) checked="checked" @endif>ซื้อหรือต่อยอดทรัพย์สินทางปัญญา(จำนวน: {{$fulltbp->fulltbpprojectcertify->cer9_qty}} )</div>
                                        <br>
                                        <div class="ml0 mt50"><input type="checkbox" @if (!Empty($fulltbp->fulltbpprojectcertify->cer11)) checked="checked" @endif>อื่น ๆ เช่น สิ่งบ่งชี้ทางภูมิศาสตร์ (GI) ความหลากหลายทางพันธุ์พืช แบบผังภูมิของวงจรรวม (จำนวน: {{$fulltbp->fulltbpprojectcertify->cer11_qty}} )</div>
                                    </td>
                                </tr>  
                            </tbody>
                        </table>
                        <div class="ml30 mt20"><strong>2.6.3 รางวัลทางด้านเทคโนโลยี/นวัตกรรม ที่ได้รับ</strong></div>
                        <div class="ml30">{!!$provider::FixBreak($fulltbp->innovation)!!}</div>
                        <div class="ml30"><strong>2.6.4 ใบรับรองมาตรฐานต่างๆ ที่ได้รับ เช่น ISO, อย., มอก., GMP, HACCP, CMMI ฯลฯ </strong></div>
                        <div class="ml30">{!!$provider::FixBreak($fulltbp->standard)!!}</div>
                    </div>
                    <div class="ml30 mt20"><strong>2.7 แผนการดำเนินงานโครงการ (Gantt Chart) </strong></div>

                    <table class="mt5 font14 border">
                        <thead>
                            <tr>
                                <tr>
                                    <th rowspan="2">รายละเอียดการดำเนินงาน</th> 
                                    <th colspan="12" class="text-center">เดือนที่</th> 
                                </tr>
                                <tr >
                                    <th style="width: 30px">1</th>
                                    <th style="width: 30px">2</th>
                                    <th style="width: 30px">3</th>
                                    <th style="width: 30px">4</th>
                                    <th style="width: 30px">5</th>
                                    <th style="width: 30px">6</th>
                                    <th style="width: 30px">7</th>
                                    <th style="width: 30px">8</th>  
                                    <th style="width: 30px">9</th>
                                    <th style="width: 30px">10</th>
                                    <th style="width: 30px">11</th>
                                    <th style="width: 30px">12</th>
                                </tr>
                            </tr>
                        </thead>
                        <tbody id="fulltbp_projectplan_wrapper_tr">    
                            @if ($fulltbp->fulltbpprojectplan->count() > 0)
                                @foreach ($fulltbp->fulltbpprojectplan as $fulltbpprojectplan)
                                    <tr >                                        
                                        <td> {{$fulltbpprojectplan->name}} </td> 
                                        @for ($i = 1; $i <= 12; $i++)
                                            @php
                                                $color = 'white';
                                                $check = $fulltbpprojectplan->fulltbpprojectplantransaction->where('month',$i)->first();
                                                if (!Empty($check)) {
                                                    $color = 'grey';
                                                }
                                            @endphp
                                            <td style="background-color:{{$color}}"> </td> 
                                        @endfor															
                                    </tr>
                                @endforeach   
                            @endif                         
                        </tbody>
                    </table>
                </div>
                <div class="box bw650 font14 mt20 " style="background-color: #bdd6ee;">
                    <div ><strong>3. ความเป็นไปได้ด้านการตลาดและแผนสู่เชิงพาณิชย์</strong></div>
                </div>
                <div class="box bw650 font14 mt20" >
                    <div class="ml30 "><strong>3.1 ข้อมูลด้านการตลาด</strong></div>
                    <div class="ml50"><strong>Market analysis</strong></div>
                    <div class="ml50">{!!$provider::FixBreak($fulltbp->fulltbpmarketanalysis->detail)!!}</div>
                    <div class="ml50"><strong>Business model canvas</strong></div>
                    <div class="ml50">{!!$provider::FixBreak($fulltbp->fulltbpmarketbusinessmodelcanvas->detail)!!}</div>
                    <div class="ml50"><strong>วิเคราะห์ศักยภาพทางการค้า</strong></div>
                    <div class="ml50">{!!$provider::FixBreak($fulltbp->fulltbpmarketswot->detail)!!}</div>
                    <div class="ml30 "><strong>3.2 ข้อมูลยอดขายของบริษัท</strong></div>
                    <div>ข้อมูลยอดขายของแต่ละผลิตภัณฑ์/บริการ (ยอดขาย 3 ปีย้อนหลัง) (หน่วย: บาท)</div>
                    <table class="mt5 font14 border tbwrap" >
                        <thead>
                            <tr>
                                <th style="width:40%">ยอดขายแยกตามประเภทผลิตภัณฑ์/บริการ</th>
                                <th style="width:15%">{{$fulltbp->past1}}</th>                                                                                    
                                <th style="width:15%">{{$fulltbp->past2}}</th>       
                                <th style="width:15%">{{$fulltbp->past3}}</th>  
                                <th style="width:20%">ปีปัจจุบัน<pre>(ประมาณการ)</pre></th>
                            <tr>
                        </thead>
                        <tbody>
                            @if ($fulltbp->fulltbpsell->count() > 0)
                                @foreach ($fulltbp->fulltbpsell as $fulltbpsell)
                                    <tr>
                                        <td> {{$fulltbpsell->name}}</td> 
                                        <td> {{number_format($fulltbpsell->present,2)}} </td> 
                                        <td> {{number_format($fulltbpsell->past1,2)}} </td> 
                                        <td> {{number_format($fulltbpsell->past2,2)}}</td>                                            															
                                        <td> {{number_format($fulltbpsell->past3,2)}}</td> 
                                    </tr>   
                                @endforeach
                                <tr>
                                    <td class="center"><strong>รวมยอดขาย</strong> </td> 
                                    <td> {{number_format($fulltbp->fulltbpsell->sum('present'),2)}} </td> 
                                    <td> {{number_format($fulltbp->fulltbpsell->sum('past1'),2)}} </td> 
                                    <td> {{number_format($fulltbp->fulltbpsell->sum('past2'),2)}}</td>                                            															
                                    <td> {{number_format($fulltbp->fulltbpsell->sum('past3'),2)}}</td> 
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="mt20">สถานะยอดขาย (สถานะยอดขาย 3 ปีย้อนหลัง) (หน่วย: บาท)</div>
                    <table class="mt5 font14 border tbwrap" >
                        <thead>
                            <tr>
                                <th style="width:40%">ระยะเวลา</th>
                                <th style="width:15%">{{$fulltbp->past1}}</th>                                                                                    
                                <th style="width:15%">{{$fulltbp->past2}}</th>       
                                <th style="width:15%">{{$fulltbp->past3}}</th>  
                                <th style="width:20%">ปีปัจจุบัน <pre>(ประมาณการ)</pre></th>
                            <tr>
                        </thead>
                        <tbody>
                            @if ($fulltbp->fulltbpsellstatus->count() > 0)
                                @foreach ($fulltbp->fulltbpsellstatus as $fulltbpsellstatus)
                                    <tr>
                                        <td> {{$fulltbpsellstatus->name}}</td> 
                                        <td> {{number_format($fulltbpsellstatus->present,2)}} </td> 
                                        <td> {{number_format($fulltbpsellstatus->past1,2)}} </td> 
                                        <td> {{number_format($fulltbpsellstatus->past2,2)}}</td>                                            															
                                        <td> {{number_format($fulltbpsellstatus->past3,2)}}</td> 
                                    </tr>   
                                @endforeach
                                <tr>
                                    <td class="center"><strong>รวมยอดขาย</strong> </td> 
                                    <td> {{number_format($fulltbp->fulltbpsellstatus->sum('present'),2)}} </td> 
                                    <td> {{number_format($fulltbp->fulltbpsellstatus->sum('past1'),2)}} </td> 
                                    <td> {{number_format($fulltbp->fulltbpsellstatus->sum('past2'),2)}}</td>                                            															
                                    <td> {{number_format($fulltbp->fulltbpsellstatus->sum('past3'),2)}}</td> 
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="mt20">คู่ค้าหลักทางธุรกิจของโครงการ : ลูกหนี้การค้า (หน่วย: บาท)</div>
                    <table class="mt5 font14 border tbwrap" >
                        <thead>
                            <tr>
                                <th style="width:30%">รายชื่อคู่ค้าหลักของธุรกิจ</th>  
                                <th style="width:15%">จำนวนผลิตภัณฑ์<pre>หรือโครงการ</pre></th> 
                                <th style="width:15%">เลขทะเบียน<pre>นิติบุคคล</pre></th>                                                                                    
                                <th style="width:10%">ยอดขายต่อปี<pre>(บาท)</pre></th>       
                                <th style="width:15%">เปรียบเทียบกับ<pre>ยอดขาย (%)</pre></th>  
                                <th style="width:15%">จำนวนปีที่ทำ<pre>ธุรกิจร่วมกัน(ปี)</pre></th> 
                            <tr>
                        </thead>
                        <tbody>
                            @if ($fulltbp->fulltbpdebtpartner->count() > 0)
                                @foreach ($fulltbp->fulltbpdebtpartner as $fulltbpdebtpartner)
                                    <tr>
                                        <td> {{$fulltbpdebtpartner->debtpartner}}</td> 
                                        <td> {{$fulltbpdebtpartner->numproject}} </td> 
                                        <td> {{$fulltbpdebtpartner->partnertaxid}} </td> 
                                        <td> {{number_format($fulltbpdebtpartner->totalyearsell,2)}}</td>                                            															
                                        <td> {{number_format($fulltbpdebtpartner->percenttosale,2)}}</td> 
                                        <td> {{number_format($fulltbpdebtpartner->businessyear,2)}}</td> 
                                    </tr>   
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="mt20">คู่ค้าหลักทางธุรกิจของโครงการ : เจ้าหนี้การค้า (หน่วย: บาท)</div>
                    <table class="mt5 font14 border tbwrap" >
                        <thead>
                            <tr>
                                <th style="width:30%">รายชื่อคู่ค้าหลักของธุรกิจ</th>  
                                <th style="width:20%">เลขทะเบียน<pre>นิติบุคคล</pre></th>                                                                                    
                                <th style="width:20%">ยอดซื้อต่อปี<pre>(บาท)</pre></th>       
                                <th style="width:15%">เปรียบเทียบกับยอดซื้อ<pre>(%)</pre></th>  
                                <th style="width:15%">จำนวนปีที่ทำ<pre>ธุรกิจร่วมกัน(ปี)</pre></th> 
                            <tr>
                        </thead>
                        <tbody>
                            @if ($fulltbp->fulltbpcreditpartner->count() > 0)
                                @foreach ($fulltbp->fulltbpcreditpartner as $fulltbpcreditpartner)
                                    <tr>
                                        <td> {{$fulltbpcreditpartner->creditpartner}}</td> 
                                        <td> {{$fulltbpcreditpartner->partnertaxid}} </td> 
                                        <td> {{number_format($fulltbpcreditpartner->totalyearpurchase,2)}}</td>                                            															
                                        <td> {{number_format($fulltbpcreditpartner->percenttopurchase,2)}}</td> 
                                        <td> {{number_format($fulltbpcreditpartner->businessyear,2)}}</td> 
                                    </tr>   
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="box bw650 font14 mt20 " style="background-color: #bdd6ee;">
                    <div ><strong>4. ข้อมูลทางด้านการเงิน</strong></div>
                </div>
                <div class="box bw650 font14 mt20" >
                    <div class="ml30 "><strong>4.1 เงินลงทุนที่จำเป็นและการจัดหาแหล่งเงินลงทุนทั้งหมดของโครงการ</strong></div>
                    <div ><strong>เงินลงทุนในสินทรัพย์ถาวรของโครงการ</strong></div>
                    <table class="mt0 font14 border tbwrap">
                        <thead>
                            <tr>
                                <th style="width:30%">รายการ</th>  
                                <th style="width:15%">จำนวนเงิน <pre>(บาท)</pre></th>                                                                                    
                                <th style="width:15%">จำนวน(ชิ้น)</th>       
                                <th style="width:15%">ราคาต่อเครื่อง<pre>(บาท)</pre></th>  
                                <th style="width:25%">ข้อมูลจำเพาะทางเทคนิค</th> 
                            <tr>
                        </thead>
                        <tbody>
                            @if ($fulltbp->fulltbpasset->count() > 0)
                                @foreach ($fulltbp->fulltbpasset as $fulltbpasset)
                                    <tr>
                                        <td> {{$fulltbpasset->asset}}</td> 
                                        <td> {{number_format($fulltbpasset->cost,2)}}</td> 
                                        <td> {{$fulltbpasset->quantity}}</td>                                            															
                                        <td> {{number_format($fulltbpasset->price,2)}}</td> 
                                        <td> {{$fulltbpasset->businessyear}}</td> 
                                    </tr>   
                                @endforeach
                                <tr>
                                    <td class="center"><strong>รวม</strong> </td> 
                                    <td> {{number_format($fulltbp->fulltbpasset->sum('cost'),2)}} </td> 
                                    <td> </td>                                            															
                                    <td> {{number_format($fulltbp->fulltbpasset->sum('price'),2)}}</td> 
                                    <td> </td> 
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div  class="mt10 font14"><strong>เงินลงทุนสำหรับดำเนินการของโครงการ</strong></div>
                    <table class="mt0 font14 border tbwrap">
                        <thead>
                            <tr>
                                <th style="width:80%">รายการ</th>  
                                <th style="width:20%">จำนวนเงิน (บาท)</th>  
                            <tr>
                        </thead>
                        <tbody>
                            @if ($fulltbp->fulltbpinvestment->count() > 0)
                                @foreach ($fulltbp->fulltbpinvestment as $fulltbpinvestment)
                                    <tr>
                                        <td> {{$fulltbpinvestment->investment}}</td> 
                                        <td> {{number_format($fulltbpinvestment->cost,2)}}</td> 
                                    </tr>   
                                @endforeach
                                <tr>
                                    <td class="center"><strong>รวม</strong> </td> 
                                    <td> {{number_format($fulltbp->fulltbpinvestment->sum('cost'),2)}} </td> 
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div  class="mt10 font14"><strong>แหล่งเงินทุนของโครงการ</strong></div>
                    <table class="mt0 font14 border">
                        <thead>
                            <tr>
                                <th style="width:30%">รายการ</th>  
                                <th style="width:15%">เงินทุนที่มีอยู่แล้ว</th>                                                                                    
                                <th style="width:15%">เงินทุนที่เสนอ<pre>ขออนุมัติ</pre> </th>   
                                <th style="width:15%">เงินทุนที่ได้รับ<pre>การอนุมัติแล้ว</pre></th>   
                                <th style="width:25%">แผนการหา <pre>เงินทุนเพิ่ม</pre></th>   
                            <tr>
                        </thead>
                        <tbody>
                            @if ($fulltbp->fulltbpcost->count() > 0)
                                @foreach ($fulltbp->fulltbpcost as $fulltbpcost)
                                    <tr>
                                        <td> {{$fulltbpcost->costname}}</td> 
                                        <td> {{number_format($fulltbpcost->existing,2)}}</td> 
                                        <td> {{number_format($fulltbpcost->need,2)}}</td> 
                                        <td> {{number_format($fulltbpcost->approved,2)}}</td> 
                                        <td> {{$fulltbpcost->plan}}</td>
                                    </tr>   
                                @endforeach
                                <tr>
                                    <td class="center"><strong>รวม</strong> </td> 
                                    <td> {{number_format($fulltbp->fulltbpcost->sum('existing'),2)}} </td> 
                                    <td> {{number_format($fulltbp->fulltbpcost->sum('need'),2)}} </td> 
                                    <td> {{number_format($fulltbp->fulltbpcost->sum('approved'),2)}} </td> 
                                    <td> </td> 
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="ml30 mt20"><strong>4.2 ประมาณการผลตอบแทนจากการลงทุน </strong></div>
                    <div class="ml30">- ประมาณการรายได้ที่จะเพิ่มขึ้น  {{number_format($fulltbp->fulltbpreturnofinvestment->income,2)}} บาท</div>
                    <div class="ml30">- ประมาณการกำไรสุทธิที่จะเพิ่มขึ้น {{number_format($fulltbp->fulltbpreturnofinvestment->profit,2)}} บาท</div>
                    <div class="ml30">- ประมาณการต้นทุนที่จะลดลง {{number_format($fulltbp->fulltbpreturnofinvestment->reduce,2)}} บาท</div>
                </div>
        </div>
        <div class="box ml50 bw650 font14 mt20 ">
            <div class="mt50"><strong><u>หมายเหตุ</u> โปรดแนบเอกสารที่เกี่ยวข้องดังต่อไปนี้</strong></div>
            <div class="ml30">1. สำเนาหนังสือรับรองจากการจดทะเบียนนิติบุคคล</div>
            <div class="ml30">2. สำเนาบัญชีรายชื่อผู้ถือหุ้น (บอจ. 5)</div>
            <div class="ml30">3. เอกสารอื่นๆ ที่เกี่ยวข้องกับโครงการ</div>
        </div>
        <div class="box ml50 bw650 font14 mt30 ">
            <div class="mt50"><strong><u>ข้อตกลง :</u></strong>
                การลงลายมือชื่อข้างท้ายนี้ ผู้ขอรับการประเมินขอรับรองและยืนยันความถูกต้องของข้อมูลและรายละเอียดตามที่ระบุไว้ในแผนธุรกิจเทคโนโลยีฉบับนี้ หากภายหลังปรากฏเหตุอันเกิดข้อพิพาทที่เกี่ยวกับโครงการนี้ว่ามีการละเมิดทรัพย์สินทางปัญญาของผู้อื่น และ/หรือปลอมแปลงเอกสารของผู้อื่น หรือไม่ว่าประการใดก็ตาม ผู้ขอรับการประเมินจะเป็นผู้รับผิดชอบทั้งทางแพ่งและอาญาแต่เพียงผู้เดียว 
            </div>
        </div>


        <table class="bw500 ml50 mt70 center border">
            <tr>
                <td class="font14" style="text-align: center;width: 200px;color:grey;border: none;">(ประทับตราบริษัท – ถ้ามี)</td>
                <td class="font14" style="text-align: right;width: 90px;border: none;"></td>
                <td class="font14" style="text-align: right;width: 300px;border: none;">
                    <table>
                        <tr>
                            <td class="font14" style="width:1px; text-align: right;border: none;">ลงชื่อ</td>
                            <td class="font14" style="width: 200px;text-align: center;border: none;">
                            @if ($fulltbp->signature_status_id == 2)
                                {{$fulltbp->minitbp->managerprefix->name}}{{$fulltbp->minitbp->managername}}  {{$fulltbp->minitbp->managerlastname}}
                            @endif
                            </td>
                            <td class="font14" style="width: 1px;border: none;">ผู้ขอรับการประเมิน</td>
                        </tr>
                        <tr>
                            <td class="font14" style="width: 1px; text-align: right;padding-top:15px;border: none;">(</td>
                            <td class="font14" style="width: 200px;text-align: center;padding-top:15px;border: none;">
                                {{-- <img src="https://www.docsketch.com/assets/vip-signatures/barack-obama-signature-b8614607575251b55f9386853536ef918f439600ccbda927b11aca9bf1d1842e.png" alt="Girl in a jacket" width="60" height="40"> --}}
                                @if ($fulltbp->signature_status_id == 2)
                                    <img src="{{asset(Auth::user()->signature)}}" alt="Girl in a jacket" width="100" height="40">
                                @endif
                            </td>
                            {{-- <td class="font14" style="width: 200px;text-align: center;padding-top:15px"></td> --}}
                            <td class="font14" style="width: 1px;text-align: left;padding-top:15px;border: none;">)</td>
                        </tr>
                        <tr>
                            <td class="font14" style="width: 1px; text-align: right;border: none;"></td>
                            <td class="font14 center" style="width: 200px;text-align: center;border: none;">เจ้าของหรือผู้บริหารระดับสูง</td>
                            <td class="font14" style="width: 1px;border: none;"></td>
            
                        </tr>
                    </table>
                
                </td>
            </tr>
        </table>



    </body>

</html>   


