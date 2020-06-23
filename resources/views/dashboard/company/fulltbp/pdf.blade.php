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
                src: url("{{ asset('assets/dashboard/fonts/thsarabunnew-webfont.ttf') }}") format('truetype');
            }
            @font-face{
                font-family:  'THSarabunNew';
                font-style: normal;
                font-weight: bold;
                src: url("{{ asset('assets/dashboard/fonts/thsarabunnew_bold-webfont.ttf') }}") format('truetype');
            }
            @font-face{
                font-family:  'THSarabunNew';
                font-style: italic;
                font-weight: normal;
                src: url("{{ asset('assets/dashboard/fonts/thsarabunnew_italic-webfont.ttf') }}") format('truetype');
            }
            @font-face{
                font-family:  'THSarabunNew';
                font-style: italic;
                font-weight: bold;
                src: url("{{ asset('assets/dashboard/fonts/thsarabunnew_bolditalic-webfont.ttf') }}") format('truetype');
            }

            body {
                font-family: "THSarabunNew";
                padding: 0;
                line-height: normal;
                background: #fff;
                font-size: 14px
            }
            .wrapper {
                position: relative;
                width: 100%;
                top: 0;
                padding: 0;
            }
            .container{
                position: relative;
                max-width: 1000px;
			    max-height: 960px;
                margin: 0 auto;
			    padding: 0; 
			    overflow: hidden;
            }
            .box{
                position: relative;
                padding-left: 25px;
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
                top:-5px; 
                left:30px;
                text-align: justify;
                word-break:break-all;
                word-wrap:break-word
            }
            /* .justifycenter {
                text-align: justify;
                text-justify: inter-word;
            }




            .box p{
                
            }
            .clear{
                clear: both;
            }
            .page-break {
                page-break-after: always;
            }
            .underlinedot{
                border-bottom: 1px dotted;
                width: 100%;
                display: block;
            }
            .lineheight1_6{
                line-height: 1.6;
            }

            p {
                border-bottom: 1px dotted black hidden;
                line-height: 30px;
                text-align: justify;
                /* text-indent: 50px; */
                word-break:break-all; 
                word-wrap:break-word;
                font-family: "thsarabunnew";
            }
            /* span {
                line-height: 30px;
                text-align: justify;
                word-break:break-all; 
                word-wrap:break-word;
                font-family: "thsarabunnew";
            } */
            /* p>span {
                padding-bottom: 0px;
                vertical-align: top;
            } */
            .page-break {
                page-break-after: always;
            } */
            
        </style>
    </head>
    <body>
        
        <div class="wrapper">
            <div class="box" style="height:50px">
                <img src="{{asset('assets/dashboard/images/ttrs.png')}}" class="left" alt="">
                <img src="{{asset('assets/dashboard/images/nstda.png')}}" class="right" alt="">
            </div>
            <div class="container" >
                <div class="box center">
                    <p>
                        <h1 style="line-height:40px;font-size:3em">แผนธุรกิจเทคโนโลยี</h1>
                        <h1 style="line-height:35px;font-size:2.5em">(Technology Business Plan: TBP)</h1>
                        <h2 style="line-height:30px;font-size:2em">ชื่อโครงการ</h2>
                        <div class="box" style="margin-top:35px;">
                        ......................................................................................................................................................................................................................
                        <span style="position: absolute; top:-5px; left:0;right:0;margin-left: auto;margin-right: auto;">dsfsdfsdf</span>
                        </div>
                    </p>
                </div>
                <div class="box">
                    
                    ......................................................................................................................................................................................................................................................................................
                    <span style="">ดร. เกรแฮม อัลลิสัน จากมหาวิทยาลัยฮาร์วาร์ดของสหรัฐฯ แบ่งปันมุมมองต่อสายสัมพันธ์จีน-สหรัฐฯ ว่าแม้มหาอำนาจทั้งสองจะยังคงประชันขันนั่น</span>
                </div>
            </div>
        </div>
    </body>
    
</html>   


