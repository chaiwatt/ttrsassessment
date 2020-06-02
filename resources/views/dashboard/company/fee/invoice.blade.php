<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=1252">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>INVOICE</title>
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
                line-height: 30px;
                text-align: justify;
                /* text-indent: 50px; */
                word-break:break-all; 
                word-wrap:break-word;
                font-family: "thsarabunnew";
            }
            span {
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
        </style>
    </head>
    <body>
        <h2>{{ $title }}</h2>
        <p class="justifycenter"><span>{{$body}}</span></p>
        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate('npctestserver.com')) !!} ">
    </body>
</html>