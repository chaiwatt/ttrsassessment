@inject('provider', 'App\Http\Controllers\DashboardAdminEvaluationResultController')
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=1252">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ความเห็นผู้เชี่ยวชาญ</title>
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
                <div class=" right" alt="" style="font-size:11px">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<strong>เอกสารสำคัญปกปิด (Private & Confidential)</strong>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;{PAGENO}/{nb}</div>
             </htmlpagefooter>
            <div class="container" >
                <div class="box"  >
                    <img src="{{asset('assets/dashboard/images/ttrs.png')}}" style="width:110px" alt="">
                    <img src="{{asset('assets/dashboard/images/nstda.png')}}" style="width:130px;margin-right:20px" class="right" alt="">
                </div>

                <div class="box bw600 border mt20 ml30 center" style="width:600px">
                    <div class="center mt10" style="font-size:13px ;width:300px;margin-left:165px"><strong>ความเห็นผู้เชี่ยวชาญ</strong></div>
                    <div class="mt20 mb20 " style="font-size:13px;width:300px;margin-left:160px"><strong>โครงการ</strong></div>
                    <div class="mb10 " style="font-size:13px;width:500px;margin-left:65px"><strong>{{$fulltbp->minitbp->project}} @if (!Empty($fulltbp->minitbp->projecteng)) ({{$fulltbp->minitbp->projecteng}})@endif</strong></div>
                </div>
      
           
                <div class="page-break"></div>

              @foreach ($expertcomments as $key => $expertcomment)
                <div class="box bw650  mt20 " style="background-color: #bdd6ee;">
                    <div style="font-size:13px;padding-top:5px;margin-left:2px" ><strong>ผู้เชี่ยวชาญที่ {{$key+1}}. คุณ{{$expertcomment->user->name}} {{$expertcomment->user->lastname}}</strong></div>
                </div>
                <div class="box bw650  mt20" >                     
                    <div class="ml10 mt0" style="font-size:13px;page-break-inside: avoid;"><strong>Overview</strong>
                        <div style="font-size:13px" >{!!$provider::FixBreak($expertcomment->overview)!!}</div>
                    </div>
                </div>
                <div class="box bw650  mt10" >                     
                    <div class="ml10 mt0" style="font-size:13px;page-break-inside: avoid;"><strong>Management</strong>
                        <div style="font-size:13px" >{!!$provider::FixBreak($expertcomment->management)!!}</div>
                    </div>
                </div>
                <div class="box bw650  mt10" >                     
                    <div class="ml10 mt0" style="font-size:13px;page-break-inside: avoid;"><strong>Technology</strong>
                        <div style="font-size:13px" >{!!$provider::FixBreak($expertcomment->technology)!!}</div>
                    </div>
                </div>
                <div class="box bw650  mt10" >                     
                    <div class="ml10 mt0" style="font-size:13px;page-break-inside: avoid;"><strong>Marketing</strong>
                        <div style="font-size:13px" >{!!$provider::FixBreak($expertcomment->marketing)!!}</div>
                    </div>
                </div>
                <div class="box bw650  mt10" >                     
                    <div class="ml10 mt0" style="font-size:13px;page-break-inside: avoid;"><strong>Business Prospect</strong>
                        <div style="font-size:13px" >{!!$provider::FixBreak($expertcomment->businessprospect)!!}</div>
                    </div>
                </div>
              @endforeach
        </div>

    </body>

</html>   


