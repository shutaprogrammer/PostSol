<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PostSol 〜不満からビジネスへ〜</title>
    <!-- BootstrapのCDNを追加 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <style>
    /* ナビゲーションバーのスタイル */
    .custom-navbar {
        background-color: black;
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

    /* フッターのスタイル */
    footer {
        background-color: black;
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

<!-- メインコンテンツ -->
<div class="container mt-5">
    <div class="whole">
        <form action="{{ route('profile.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <h2 class="title">プロフィールを作成しよう！！</h2>

        <div class="icon">
            <div>
                <label for="img">アイコン</label>
            </div>
            <div>
                <input type="file" name="img" id="img" value="{{ $user->img }}">
            </div>
        </div>

        <div class="gender">
            <div>
                <label>性別</label>
            </div>
                <div>
                    <input type="radio" id="male" name="gender" value="男性" 
                    {{ $user->gender == '男性' ? 'checked' : '' }}>
                    <label for="male">男性</label>
                </div>
                <div>
                    <input type="radio" id="female" name="gender" value="女性" 
                    {{ $user->gender == '女性' ? 'checked' : '' }}>
                    <label for="female">女性</label>
                </div>
                <div>
                    <input type="radio" id='no_answer' name="gender" value="未回答" 
                    {{ $user->gender == '未回答' ? 'checked' : '' }}>
                    <label for="no_answer">未回答</label>
                </div>
        </div>

        <div >
            <div class="birth">
                <label>生まれ年</label>
            </div>
            <div>
                <select name="birth" id="birth">
                    @foreach($years as $year)
                    <option value="{{ $year }}" {{ $user->birth == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="country">
            <div>
                <label>お住まいの国</label>
            </div>
            <div>
                <input type="text" name="country" placeholder="日本" value="{{ $user->country }}">
            </div>
        </div>

        <div class="prefecture">
            <div>
                <label>お住まいの都道府県/州</label>
            </div>
            <div>
                <select name="prefecture" id="prefecture">
                @foreach($prefectures as $prefecture)
                <option value="{{ $prefecture }}" {{ $user->prefecture == $prefecture ? 'selected' : '' }}>{{ $prefecture }}</option>
                @endforeach
                </select>
            </div>
        </div>

        <div class="city">
            <div>
                <label>お住まいの市町村</label>
            </div>
            <div>
                <input type="text" name="city" placeholder="広島市" value="{{ $user->city }}">
            </div>
        </div>

        <button type="submit" class="button">プロフィール作成</button>
        </form>
    </div>
</div>

<!-- フッター -->
<footer>
    <p>&copy; 2024 PostSol. All rights reserved.</p>
</footer>

<!-- Bootstrap JavaScriptのCDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<head><link rel="stylesheet" href="{{ asset('css/create_profile.css') }}"></head>




