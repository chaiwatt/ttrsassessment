@inject('provider', 'App\Http\Controllers\DashboardAdminEvaluationResultController')
@inject('thainumeric', 'App\Helper\ThaiNumericConverter')
@inject('dateconversion', 'App\Helper\DateConversion')

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=1252">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>จดหมายแจ้งผลการประเมิน</title>
        <link href="{{asset('assets/dashboard/css/pdf.css')}}" rel="stylesheet" type="text/css">
        <style>
            @page {
            footer: page-footer;
        }
        </style>
    </head>
    <body>

        <div class="wrapper">
            <div class="container" >
                <div class="box"  >
                    <img src="{{asset('assets/dashboard/images/nstda.png')}}" style="width:130px;margin-right:20px" class="right" alt="">
                </div>

                <div class="box bw600 mt20 ml30">
                    <div>{{$thainumeric::toThaiNumeric($evaluationresult->headercode)}}</div>
                    <div class="bw400 text-right">{{$thainumeric::toThaiNumeric($evaluationresult->evaluation_day_id)}} {{$evaluationresult->month->name}} {{$thainumeric::toThaiNumeric($dateconversion::thaiYearNow())}}</div>
                </div>

                <div class="box mt20 ml30">
                    <div>เรื่อง  แจ้งผลการประเมินศักยภาพผู้ประกอบการโดย TTRS Model</div>
                    <div>เรียน  คุณ{{$fulltbp->fulltbpresponsibleperson->name}}  {{$fulltbp->fulltbpresponsibleperson->lastname}}</div>
                    <div class="ml35">กรรมการผู้จัดการ {{$fulltbp->minitbp->businessplan->company->fullname}}</div>
                    <div class="ml70 ">ตามที่ท่านได้แจ้งความประสงค์เข้ารับบริการประเมินศักยภาพผู้ประกอบการโดย TTRS Model</div>
                    <div class="bw600"><strong>โครงการเลขที่ {{$thainumeric::toThaiNumeric($fulltbp->minitbp->businessplan->code)}} เรื่อง "{{$fulltbp->minitbp->project}}"</strong> ของ <strong>{{$fulltbp->minitbp->businessplan->company->fullname}}</strong></div>
                    <div>ความละเอียดทราบแล้วนั้น</div>
                    <div class="box ml50 text-justify" style="width:550px;word-wrap:break-word" ><span>บัดนี้ สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.) โดยศูนย์สนับสนุนและให้บริการ</span></div>
                    <div class="box bw600 text-justify" style="word-wrap:break-word" >ประเมินจัดอันดับเทคโนโลยีของประเทศบริการประเมินจัดอันดับเทคโนโลยีของประเทศ (TTRS) ได้ทำการ</div>
                    <div class="box bw600 text-justify" style="word-wrap:break-word">ประเมินเสร็จสิ้นเป็นที่เรียบร้อยแล้ว จึงขอแจ้งผลการประเมินศักยภาพผู้ประกอบการโดย TTRS Model ซึ่ง</div>
                    <div class="box bw600 text-justify" style="word-wrap:break-word">ได้คะแนน {{$thainumeric::toThaiNumeric(intVal($fulltbp->projectgrade->percent))}} คะแนน จากคะแนนเต็ม {{$thainumeric::toThaiNumeric('100')}} คะแนนคิดเป็นเกรดระดับ {{$fulltbp->projectgrade->grade}} โดยมีประเด็นสำคัญในการ</div>
                    <div class="box bw600 text-justify" style="word-wrap:break-word">กำหนดระดับคะแนนและข้อเสนอแนะจากประเมิน ดังต่อไปนี้</div>
                </div>
                <div class="box mt10 ml30">
                    
                    <div ><strong>๑. ด้านการบริหารจัดการ (Management)</strong></div>
                    <div class="box bw600 text-justify" >{!!$provider::FixBreak($evaluationresult->management)!!}</div>
                    
                </div>
                <div class="box mt10 ml30">
                    <div ><strong>๒. ด้านเทคโนโลยีและนวัตกรรม (Technology and Innovation)</strong></div>
                    <div class="box bw600 text-justify">{!!$provider::FixBreak($evaluationresult->technoandinnovation)!!}</div>
                </div>
                <div class="box mt10 ml30">
                    <div ><strong>๓. ด้านความเป็นไปได้ทางการตลาด (Marketability)</strong></div>
                    <div class="box bw600 text-justify">{!!$provider::FixBreak($evaluationresult->marketability)!!}</div>
                </div>
                <div class="box mt10 ml30">
                    <div ><strong>๔. ด้านความเป็นไปได้ทางธุรกิจ (Business Propect)</strong></div>
                    <div class="box bw600 text-justify">{!!$provider::FixBreak($evaluationresult->businessprospect)!!}</div>
                </div>
                <div class="box mt15" style="page-break-inside: avoid;">
                    <div class="ml70">อนึ่ง หากท่านต้องการสอบถามข้อมูลเพิ่มเติม โปรดติดต่อ คุณ{{$evaluationresult->contactname}} {{$evaluationresult->contactlastname}} ตำแหน่ง {{$evaluationresult->contactposition}}</div>
                     
                    <div class="ml30">หมายเลขโทรศัพท์ {{$thainumeric::toThaiNumeric($generalinfo->phone1)}} ต่อ {{$thainumeric::toThaiNumeric($evaluationresult->contactphoneext)}} หรือ อีเมล {{$evaluationresult->contactemail}}</div>
                    <div class="ml70 mt20">จึงเรียนมาเพื่อทราบ</div>
                    <div class="box ml200 mt20 bw400 text-center">
                        ขอแสดงความนับถือ
                        <div class="mt40">(..................................................................)</div>
                        <div >รองผู้อำนวยการ</div>
                        <div >ปฏิบัติการแทนผู้อำนวยการ</div>
                        <div >สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ</div>
                    </div>
                </div>
                <div class="box mt50">
                    <div class="ml30"><span class="font12">ศูนย์บริหารจัดการเทคโนโลยี</span> </div>
                    <div class="ml30"><span class="font12">ศูนย์สนับสนุนและให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศ (TTRS)</span> </div>
                    <div class="ml30"><span class="font12">โทรศัพท์ {{$thainumeric::toThaiNumeric($evaluationresult->contactphone)}} ต่อ คุณ{{$evaluationresult->contactname}} {{$evaluationresult->contactlastname}}</span> </div>
                    <div class="ml30"><span class="font12">โทรสาร {{$thainumeric::toThaiNumeric($evaluationresult->contactfax)}}</span> </div>
                </div>
        </div>
    </body>
</html>   


