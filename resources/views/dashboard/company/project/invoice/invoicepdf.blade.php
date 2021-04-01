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
            {{-- <htmlpagefooter name="page-footer">
                <div class="font12 right" alt="">F-CO-TTRS-02 rev0&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<strong>เอกสารสำคัญปกปิด (Private & Confidential)</strong>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;{PAGENO}/{nb}</div>
             </htmlpagefooter> --}}
            <div class="container" >
                <div class="box"  >
                    {{-- <img src="{{asset('assets/dashboard/images/ttrs.png')}}" style="width:120px" alt=""> --}}
                    <img src="{{asset('assets/dashboard/images/nstda.png')}}" style="width:130px;margin-right:20px" class="right" alt="">
                </div>
                <div><strong>แผนธุรกิจเทคโนโลยี</strong></div>
                <div class="font12">111 อุทยาน</div>

{{-- 
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
                </div> --}}
                <div class="box center mt20 mb20 ">
                    <div><strong>แผนธุรกิจเทคโนโลยีเพื่อเข้ารับการประเมินโดย TTRS Model</strong></div>
                </div>

                </div>
        </div>




    </body>

</html>   


