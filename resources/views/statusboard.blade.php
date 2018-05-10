<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Red Squadron Status Board</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #000;
                color: #FF0000;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .box{
                float: left;
                width:10px;
                height:10px;
            }
            
            .red{background:#f00;            }
            .green{background:#0f0;            }
            .yellow{background:#ff0;            }
            .blue{background:#00f;            }
            .purple{background:#c0f;            }
            .cyan{background:#0ff;            }
            .grey{background:#555;            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Red Squadron Status Board
                </div>
                @if (count($rss) > 0)                
                    <div class="statustable m-b-md">
                        <table border = 0>
                            <TR>
                                <TH>Pilot<TH>Call Sign<TH>Rank<TH>Kills<TH>Ship<TH>Name<TH>Type<TH colspan=2>Status
                            </TD></TR>
                            <tbody>
                                    @foreach ($rss as $line)
                                        <tr>
                                            <td class="table-text"><div>{{ $line->name }}</div></td>
                                            <td class="table-text"><div>{{ $line->callname }}</div></td>
                                            <td class="table-text"><div>{{ $line->rank }}</div></td>
                                            <td class="table-text"><div>{{ $line->kills }}</div></td>
                                            <td class="table-text"><div>{{ $line->shipid }}</div></td>
                                            <td class="table-text"><div>{{ $line->shipname }}</div></td>
                                            <td class="table-text"><div>{{ $line->shiptype }}</div></td>
                                            <td class="table-text"><div>{{ $line->shipstatus }}</div></td>
                                            <td class="table-text">

                                                <div class="box white" style="width:10px;height:{{ $line->propulsionstatus * 10 }}px";></div>
                                                <div class="box blue" style="width:10px;height:{{ $line->shieldstatus * 10 }}px";> </div>
                                                <div class="box red" style="width:10px;height:{{ $line->weoponstatus * 10 }}px";> </div>                           
                                                <div class="box green" style="width:10px;height:{{ $line->lifesupportstatus * 10 }}px";> </div>                           
                                                <div class="box grey" style="width:10px;height:{{ $line->structurestatus * 10 }}px";> </div>                           
                                                <div class="box purple" style="width:10px;height:{{ $line->navstatus * 10 }}px";> </div>                           
                                                <div class="box cyan" style="width:10px;height:{{ $line->commstatus * 10 }}px";> </div>                           
                                                                        </td>
                                        </tr>
                                    @endforeach

                        </Table>
                    </div>
                @endif

                <div class="links">
                    <A href="https://localhost/laravelapps/l1/public/">Return</A>
                </div>
            </div>
        </div>
    </body>
</html>
