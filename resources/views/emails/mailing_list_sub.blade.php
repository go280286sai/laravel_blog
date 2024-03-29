<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width"/>
    <!-- For development, pass document through inliner -->

    <style type="text/css">

        * {
            margin: 0;
            padding: 0;
            font-size: 100%;
            font-family: 'Avenir Next', "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            line-height: 1.65;
        }

        img {
            max-width: 100%;
            margin: 0 auto;
            display: block;
        }

        body,
        .body-wrap {
            width: 100% !important;
            height: 100%;
            background: #efefef;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
        }

        a {
            color: #71bc37;
            text-decoration: none;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .button {
            display: inline-block;
            color: white;
            background: #71bc37;
            border: solid #71bc37;
            border-width: 10px 20px 8px;
            font-weight: bold;
            border-radius: 4px;
        }

        h1, h2, h3, h4, h5, h6 {
            margin-bottom: 20px;
            line-height: 1.25;
        }

        h1 {
            font-size: 32px;
        }

        h2 {
            font-size: 28px;
        }

        h3 {
            font-size: 24px;
        }

        h4 {
            font-size: 20px;
        }

        h5 {
            font-size: 16px;
        }

        p, ul, ol {
            font-size: 16px;
            font-weight: normal;
            margin-bottom: 20px;
        }

        .container {
            display: block !important;
            clear: both !important;
            margin: 0 auto !important;
            max-width: 580px !important;
        }

        .container table {
            width: 100% !important;
            border-collapse: collapse;
        }

        .container .masthead {
            padding: 80px 0;
            background: #f8f8f8;
            color: #000000;
        }

        .container .masthead h1 {
            margin: 0 auto !important;
            max-width: 90%;
            text-transform: uppercase;
        }

        .container .content {
            background: white;
            padding: 30px 35px;
        }

        .container .content.footer {
            background: none;
        }

        .container .content.footer p {
            margin-bottom: 0;
            color: #888;
            text-align: center;
            font-size: 14px;
        }

        .container .content.footer a {
            color: #888;
            text-decoration: none;
            font-weight: bold;
        }


    </style>
    <title>{{$title??''}}</title>
</head>
<body>
<table class="body-wrap">
    <tr>
        <td class="container">
            <!-- Message start -->
            <table>
                <tr class="masthead">
                    <td width="30%"><img src="{{env('APP_URL')}}/uploads/doc/blog.png" alt=""></td>
                    <td><h3>{{__('messages.blog_title')}}</h3></td>
                </tr>
                <tr>
                    <td class="content" colspan="2">
                        <img src="{{env('APP_URL')}}/uploads/doc/new3.jpg" alt="">
                    </td>
                </tr>
                <tr>
                    <td class="content" colspan="2">
                        <h2>{{__('messages.dear_subs')}}</h2>
                        {!! $content??'' !!}
                    </td>
                </tr>
                <tr class="masthead">
                    <td class="content" width="40%">
                        <img src="{{env('APP_URL')}}/uploads/doc/new2.jpeg" width=100% alt="">
                    </td>
                    <td class="content">У Різдвяний вечір славний <br>
                        Щастя побажаю я.<br>
                        Щоб удача вам сприяла,<br>
                        Не хворіла щоб сім’я.<br>
                        Дім хай буде ваш багатим,<br>
                        Ситним буде стіл завжди,<br>
                        Віра хай відводить смуток,<br>
                        Захистить вас від біди.
                    </td>
                </tr>
                <tr class="masthead">
                    <td class="content" width="40%">
                        Хай Різдво вам диво подарує,<br>
                        Яскравими емоціями зачарує,<br>
                        Хай принесе в родину достаток,<br>
                        У дім — добробут і порядок.<br>
                        Бажаю злагоди й душевного тепла,<br>
                        Щоб щасливою сім`я ваша була!
                    </td>
                    <td class="content">
                        <img src="{{env('APP_URL')}}/uploads/doc/new1.jpg" width=100% alt="">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="container">
            <!-- Message start -->
            <table>
                <tr>
                    <td class="content footer" align="center">
                        <p>Sent by <a href="{{env('APP_URL')}}">My blog</a>, Kharkov</p>
                        <p><a href="mailto:">admin@admin.ua</a> | <a href="{{env('APP_URL').'/unsubscribe/'.$id}}">Unsubscribe</a>
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
