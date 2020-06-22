<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=1252">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>MPDF</title>
        <style>
            body {
                font-family: "thsarabunnew";
                font-size: 14px
            }
            .justifycenter {
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
            p {
                border-bottom: 1px dotted black hidden;
                line-height: 30px;
                text-align: justify;
                /* text-indent: 50px; */
                word-break:break-all; 
                word-wrap:break-word;
                font-family: "thsarabunnew";
            }
            span {
                border-bottom: 1px  dotted;
                line-height: 30px;
                text-align: justify;
                /* text-indent: 50px; */
                word-break:break-all; 
                word-wrap:break-word;
                font-family: "thsarabunnew";
            }
            p>span {
                padding-bottom: 0px;
                vertical-align: top;
            }
            table {
                /* border: 0.01em solid #000000; */
                border-collapse: collapse;
            }
            table td, th, tr {
                border: 0.01em solid #000000;
                font-size: 14px;
                padding-bottom: 5px;
                padding-top: 5px;
                line-height:14px;
                /* padding-left:5px; */
            }

            table th {
                line-height:20px;
            }


        </style>
    </head>
    <body>
        <h1>{{ $title }}</h1>
        <p class="justifycenter"><span>{{$body}}</span></p>
        <table style="width:100% ; margin-top: 10px;" >
            <tr>
                <th>ชื่อ</th>
                <th>ff</th>
            </tr>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        

    </table>
    </body>
</html>