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
            p{
                border-bottom: 1px dotted black hidden;
                line-height: 10px;
                text-align: justify;
                word-break: break-all;
                word-wrap: break-word;
                font-family: "thsarabunnew";
            }
            p.ex1 {
                margin-left: 200px;
            }
            p.ex2 {
                margin-left: 230px;
            }
            p.ex3 {
                margin-left: 250px;
            }
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
            div {
                padding: 30px;
                border: 1px solid black;
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
        <div class="colorblack">
            <h1 >แบบคำขอรับบริการประเมิน TTRS</h1>
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
        </div>

        {{-- <div class="colorgreen"> ชื่อบริษัท  	          …………………………………………………………………………………………………………………………………………………………………………………………………………………………………</div>
        <div class="colorgreen"> ที่อยู่     	          …………………………………………………………………………………………………………………………………………………………………………………………………………………………………</div>
        <div class="colorgreen"> เบอร์โทรศัพท์	         …………………………………………………………………………………………………………………………………………………………………………………………………………………………………</div>
        <div class="colorgreen"> E-mail                …………………………………………………………………………………………………………………………………………………………………………………………………………………………………</div>
        <div class="colorgreen"> ชื่อโครงการ/ชื่อเทคโนโลยี	…………………………………………………………………………………………………………………………………………………………………………………………………………………………………</div>
        <h1>{{$title}}</h1> --}}
        {{-- <p><span>{{$body}}</span></p> --}}
    </body>
</html>