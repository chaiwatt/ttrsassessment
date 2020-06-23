<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=1252">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Report</title>
        <style>
            @font-face{
                font-family:  'THSarabunNew';
                font-style: normal;
                font-weight: normal;
                src: url("{{ asset('assets/dashboard/fonts/pdf/thsarabunnew-webfont.ttf') }}") format('truetype');
            }
            @font-face{
                font-family:  'THSarabunNew';
                font-style: normal;
                font-weight: bold;
                src: url("{{ asset('assets/dashboard/fonts/pdf/thsarabunnew_bold-webfont.ttf') }}") format('truetype');
            }
            @font-face{
                font-family:  'THSarabunNew';
                font-style: italic;
                font-weight: normal;
                src: url("{{ asset('assets/dashboard/fonts/pdf/thsarabunnew_italic-webfont.ttf') }}") format('truetype');
            }
            @font-face{
                font-family:  'THSarabunNew';
                font-style: italic;
                font-weight: bold;
                src: url("{{ asset('assets/dashboard/fonts/pdf/thsarabunnew_bolditalic-webfont.ttf') }}") format('truetype');
            }

            body {
                margin-top: -10px;
			    padding: 0;
                font-family: "THSarabunNew";
                /* padding: 0; */
                /* line-height: normal; */
                /* background: #fff; */
                /* font-size: 14px; */
                /* border: dashed 2px; */
                /* position: relative; */
            }
            .wrapper {
                position: relative;
                width: 100%;
                padding: 0;
            }
            .container{
                margin-left: 30px;
                position: relative;
                max-width: 820px;
			    max-height: 960px;
			    padding: 0; 
			    overflow: hidden;
            }
            .box{
                position: relative;
            }
            /* .box span{
                text-align: justify;
                word-break:break-all; 
                word-wrap:break-word;
            } */
            .left {
                float:left;
            }
            .right {
                float:right;
            }
            div.center {
                width: 750px;
                height: 250px;
                display: block;
                margin-top: 20px;
                margin-left: auto;
                margin-right: auto;
                border: 1px solid black;
                text-align:center
            }
            .box span{
                position: absolute; 
                top:-3px; 
                left:10px;
                text-align: justify;
                word-break:break-all;
                word-wrap:break-word
            }

            .page-break {
                page-break-after: always;
            } */
            
        </style>
    </head>
    <body>
        <div class="wrapper">

            <div class="container" >
                <div class="box"  >
                    <img src="{{asset('assets/dashboard/images/ttrs.png')}}" style="width:175px;width:145px" alt="">
                    <img src="{{asset('assets/dashboard/images/nstda.png')}}" style="width:200px;width:180px" class="right"  alt="">
                </div>

                <div class="box center">
                    <h1 style="line-height:40px;font-size:40px">แผนธุรกิจเทคโนโลยี</h1>
                    <h1 style="line-height:35px;font-size:35px">(Technology Business Plan: TBP)</h1>
                    <h2 style="line-height:30px;font-size:30px">ชื่อโครงการ</h2>
                    <div class="box" style="margin-top:35px;">
                    ..................................................................................................................................................................................................
                    <p style="position: absolute; top:-20px; left:0;right:0;margin-left: auto;margin-right: auto;">ดร. เกรแฮม อัลลิสัน จากมหาวิทยาลัยฮาร์วาร์ดของสหรัฐฯ</p>
                    </div>
                </div>
                <div class="box">
                    ......................................................................................................................................................................................................................................................................................
                    <span style="">ดร. เกรแฮม อัลลิสัน จากมหาวิทยาลัยฮาร์วาร์ดของสหรัฐฯ แบ่งปันมุมมองต่อสายสัมพันธ์จีน-สหรัฐฯ ว่าแม้มหาอำนาจทั้งสองจะ</span>
                </div>
                <div class="box">
                    ......................................................................................................................................................................................................................................................................................
                    <span style="">ดร. เกรแฮม อัลลิสัน จากมหาวิทยาลัยฮาร์วาร์ดของสหรัฐฯ แบ่งปันมุมมองต่อสายสัมพันธ์จีน-สหรัฐฯ ว่าแม้มหาอำนาจทั้งสองจะ</span>
                </div>
                <div class="box">
                    ......................................................................................................................................................................................................................................................................................
                    <span style="">ดร. เกรแฮม อัลลิสัน จากมหาวิทยาลัยฮาร์วาร์ดของสหรัฐฯ แบ่งปันมุมมองต่อสายสัมพันธ์จีน-สหรัฐฯ ว่าแม้มหาอำนาจทั้งสองจะ</span>
                </div>
                <div class="box">
                    ......................................................................................................................................................................................................................................................................................
                    <span style="">ดร. เกรแฮม อัลลิสัน จากมหาวิทยาลัยฮาร์วาร์ดของสหรัฐฯ แบ่งปันมุมมองต่อสายสัมพันธ์จีน-สหรัฐฯ ว่าแม้มหาอำนาจทั้งสองจะ</span>
                </div>
                <div class="box">
                    ......................................................................................................................................................................................................................................................................................
                    <span style="">ดร. เกรแฮม อัลลิสัน จากมหาวิทยาลัยฮาร์วาร์ดของสหรัฐฯ แบ่งปันมุมมองต่อสายสัมพันธ์จีน-สหรัฐฯ ว่าแม้มหาอำนาจทั้งสองจะ</span>
                </div>
                <div class="box">
                    ......................................................................................................................................................................................................................................................................................
                    <span style="">ดร. เกรแฮม อัลลิสัน จากมหาวิทยาลัยฮาร์วาร์ดของสหรัฐฯ แบ่งปันมุมมองต่อสายสัมพันธ์จีน-สหรัฐฯ ว่าแม้มหาอำนาจทั้งสองจะ</span>
                </div>
            </div>
        </div>
    </body>
    
</html>   


