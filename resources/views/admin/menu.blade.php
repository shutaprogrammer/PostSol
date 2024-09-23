@extends('admin.admin_layout')
@section('content')

<head>
    <style>

        #bodyall{
            display: flex;
            flex-direction: row

        }
        #bodyleft{
            width: 25vw;
        }

        #bodymiddle{
            width: 50vw;
            font-size: 25px;
        }

        #bodymiddle > ul{
            list-style: none;
            
            text-align: center
        }

        #bodymiddle > ul > li > a {
            text-decoration: none;
            color: rgb(57, 57, 71);
        }

        #bodyright{
            width: 25vw;
        }
    </style>
</head>

<body>
    <main>
        <div id="bodyall">
            <div id="bodyleft"></div>
            <div id="bodymiddle">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{ route('admin.reports') }}">通報履歴</a></li>
                    <li class="list-group-item"><a href="{{ route('admin.exchange') }}">アマギフ換金機歴</a></li>
                    <li class="list-group-item"><a href="{{ route('admin.inbox') }}">お問い合わせ受信BOX</a></li>
                    <li class="list-group-item"><a href="#">広告掲載</a></li>
                </ul>
            </div>
            <div id="bodyright"></div>
        </div>
    
    </main>
@endsection