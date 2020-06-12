<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=1252">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>MPDF</title>
        <style>
            body{
                font-family: "thsarabunnew";
                font-size: 18px;
            }
            #wrapper {
                /* max-width: 718px;
                max-height: 1280px; */
                width:100%;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 718px;
                height: 800px;
                margin: 0 auto;
                padding: 0;
                overflow: hidden;
                border: 1px solid black;
            }
            .header{
                width: 718px;
                height: 30px;
                margin: 0 auto;
                padding: 0;
                overflow: hidden;
                background-color: aqua
            }
            .leftlogo{
                width: 100px;
                height: 30px;
                overflow: hidden;
                float:left;
                background-color: aquamarine
            }
            .rightlogo{
                width: 100px;
                height: 30px;
                overflow: hidden;
                float:right;
                background-color: aquamarine
            }
            .boxonlyofficer{
                width: 100px;
                height: 20px;
                border-bottom: 1px solid black;
                border-right: 1px solid black;
                float:left;
            }
            .boxonlyofficer_1{
                width: 150px;
                height: 20px;
                border-bottom: 1px solid black;
                border-right: 1px solid black;
                background-color: bisque;
                float:left;
            }
            .timestamp{
                width: 100px;
                height: 30px;
                float:right;
                /* clear: both; */
                background-color: aquamarine
            }
            .section1_left{
                width: 25%;
                height: 200px;
                padding: 5px;
                background-color: blueviolet;
                float: left;
            }
            .section1_right{
                width: 70%;
                height: 200px;
                padding: 5px;
                background-color:burlywood;
                float: right;
            }
            .section2_left{
                width: 45%;
                height: 250px;
                padding: 5px;
                background-color: blueviolet;
                float: left;
            }
            .section2_right{
                width: 50%;
                height: 250px;
                padding: 5px;
                background-color:burlywood;
                float: right;
            }
            .section3{
                width: 100%;
                height: 200px;

                background-color:gray;
                margin-left: 10px;
                text-align: center;
                float: right;
                overflow: hidden;
            }
            .checkbox {
                height: 10px;  
                width: 5px;
                /* float:left; */
                display: block;
                border: 1px solid black;
                clear:both;
                background-color: blue
            }
            .clear{
                clear: both;
            }
            .justifycenter{
                text-align: justify;
                text-justify: inter-word;
            }
            .underlinedot{
                border-bottom: 1px dotted;
                width: 100%;
                display: block;
            }
            .lineheight1_6{
                line-height: 1.6;
            }
            h1{
                text-align: center;
            }
            /* p{
                border-bottom: 1px dotted black hidden;
                line-height: 10px;
                text-align: justify;
                word-break: break-all;
                word-wrap: break-word;
                font-family: "thsarabunnew";
            } */

            /* span{
                border-bottom: 1px dotted;
                line-height: 30px;
                text-align: justify;
                word-break: break-all;
                word-wrap: break-word;
                font-family: "thsarabunnew";
            }
            p>span{
                padding-bottom: 0px;
                vertical-align: top;
            } */
            .colorblack{
                color:black;
            }
            .darkbg{
                background-color: black;
                color: white;
            }

            table {
                border-collapse: collapse;
            }
            table, td{
                border: 1px solid black;
                padding: 10px;
                line-height: 15px;
            }
        </style>
    </head>
    <body>     
        <div id="wrapper">
            <div class="header">
                <div class="leftlogo">
                    แปมผา
                </div>
                <div class="rightlogo">
                    แปมผา
                </div>
            </div>
            <div class="container">
                <div class="boxonlyofficer">
                    sdfsf
                </div>
                <div class="boxonlyofficer_1">
                    sdfsf...............
                </div>
                <div class="timestamp">
                   aaaaa
                </div>
                <h1 class="clear">แบบคำขอรับบริการประเมิน TTRS</h1>
                <div class="section1_left">
                    test
                 </div>
                 <div class="section1_right">
                    test2
                 </div>
              
              <span class="clear">gdfgdfgdgdfg</span>
              <div class="section2_left">
                test
                <div class="checkbox">

                </div>
             </div>
             <div class="section2_right">
                test2
             </div>
             <div class=" clear section3">
                 <p>ข้าพเจ้าขอรับรองว่าข้อมูลทั้งหมดถูกต้อง ครบถ้วน และเป็นความจริงทุกประการ</p>
                 <p>ข้าพเจ้าขอรับรองว่าข้อมูลทั้งหมดถูกต้อง ครบถ้วน และเป็นความจริงทุกประการ</p>
                 <p>ข้าพเจ้าขอรับรองว่าข้อมูลทั้งหมดถูกต้อง ครบถ้วน และเป็นความจริงทุกประการ</p>
             </div>
            </div>
           {{-- <div class="colorblack">
                
                 <p>ชื่อ-นามสกุล…………………………………………………………………………………………………………………………………</p>
                 <p>ชื่อบริษัท…………………………………………………………………………………………………………………………………</p>
                 <p>ที่อยู่…………………………………………………………………………………………………………………………………</p>
                 <p>เบอร์โทรศัพท์…………………………………………………………………………………………………………………………………</p>
                 <p>E-mail…………………………………………………………………………………………………………………………………</p>
                 <p>ชื่อโครงการ/ชื่อเทคโนโลยี…………………………………………………………………………………………………………………………………</p>
                 <br>
                 <p>วัตถุประสงค์ของการยื่นประเมินเทคโนโลยี (สามารถเลือกได้มากกว่า 1 ข้อ)</p>
                 <table>
                    <tr>
                        <td>
                            <p>สิทธิประโยชน์ทางการเงิน (Finance)</p><br>
                            <p>ขอสินเชื่อกับธนาคาร……………………………………………………………</p><br>
                            <p>วงเงินสินเชื่อที่ต้องการ……………………………………………………บาท</p><br>
                            <p>ขอรับการค้ำประกันสินเชื่อฯ บสย.</p><br>      
                            <p>(บรรษัทประกันสินเชื่ออุตสาหกรรมขนาดย่อม)</p><br>   
                            <p>โครงการเงินกู้ดอกเบี้ยต่ำ (สวทช.)</p><br>        
                            <p>บริษัทร่วมทุน (สวทช.)</p><br>  
                            <p>มูลค่าลงทุนที่ต้องการ…………………………………………………บาท</p><br>
                            <p>สัดส่วนการลงทุน (บริษัท : สวทช.)…………… : ……………</p><br>
                        </td>
                        <td><p>สิทธิประโยชน์ที่ไม่ใช่การเงิน (์Non-Finance)</p><br>
                            <p>โครงการขึ้นทะเบียนบัญชีนวัตกรรมไทย</p><br>
                            <p>รับรองขอรับสิทธิประโยชน์ทางภาษี</p><br>
                            <p>โครงการ spin-off</p><br>
                            <p>ที่ปรึกษาทางด้านเทคนิค/ด้านธุรกิจ</p><br>
                            <p>โครงการสนับสนุนผู้ประกอบการภาครัฐ โปรดระบุ</p><br>
                            <p>…………………………………………………………………………………………………</p><br>
                            <p>อื่นๆ โปรดระบุ……………………………………………………………………</p><br>
                        </td>    
                      </tr>
                 </table><br>
                 <p class="ex1">ข้าพเจ้าขอรับรองว่าข้อมูลทั้งหมดถูกต้อง ครบถ้วน และเป็นความจริงทุกประการ</p>
                 <p class="ex2">ลงชื่อ……………………………………………………………………………………………</p>
                 <p class="ex3">(…………………………………………………………………………………………)</p>
                 <p class="ex2">ตำแหน่ง………………………………………………………………………………………</p>
                 <p class="ex2">วัน/เดือน/ปี…………………………………………………………………</p>
            </div> --}}
        </div>  
    </body>
</html>