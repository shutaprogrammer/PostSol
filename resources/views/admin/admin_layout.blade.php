<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PostSol_管理者</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    html, body {
        height: 100%;
    }

    #app {
        min-height: 100%;
        display: flex;
        flex-direction: column;
        color: #ffffff;
    }

    #content {
        flex: 1;
    }

    
    /* ナビゲーションバーのスタイル */
    .custom-navbar {
        background-color: rgb(84, 84, 100);
        padding: 10px; /* 上下のパディングを追加 */
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* タイトルの色を白に設定 */
    .navbar-brand {
        color: #ffffff !important; /* 文字色を白に設定 */
        font-weight: bold;
        font-size: 100%; /* タイトルのサイズを大きくする */
        display: flex;
        align-items: center;
    }

    /* 画像のサイズ調整 */
    .navbar-brand img {
        max-height: 40px; /* 画像の高さを最大40pxに設定 */
        margin-right: 10px; /* 画像とテキストの間にマージンを追加 */
    }

    /* 他のリンクのスタイル */
    .navbar-nav .nav-link {
        color: #bdc3c7;
    }

    .navbar-nav .nav-link:hover {
        color: #ecf0f1;
    }

    /* ハンバーガーメニューアイコン */
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba%28236, 240, 241, 1%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }

    h1 {
        color: rgb(84, 84, 100) !important;
        display: block !important;
        visibility: visible !important;
    }


    /* フッターのスタイル */
    footer {
        background-color: rgb(84, 84, 100);
        color: #ffffff;
        text-align: center;
        padding: 10px 0;
        /* position: fixed; */
        margin-top: 8vh;
        bottom: 0;
        width: 100%;
    }
    </style>
</head>
<body>
    <div id="app">
        <header>
            <!-- ヘッダー。ハンバーガーメニュー -->
            <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="{{ Storage::url('imgs/ロゴ.png') }}" alt="ロゴ">
                            PostSol 〜不満からビジネスへ〜
                    </a>
                    <a href="{{ route('admin.menu') }}" style="text-decoration:none; color:#ffffff;"><p>管理者TOP</p></a>
                </div>
            </nav>
        </header>
    
        <div class="container mt-5" id="content">
            @yield('content')
        </div>

        <footer>
            <div>
                <p>&copy; 2024 PostSol. All rights reserved.</p>
            </div>
        </footer>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>