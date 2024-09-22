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
        margin-top: 8vh;
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    .container{
        margin-top: 8vh;
    }

    .card-header{
        background-color: black;
        color: white;
    }

    body{
        background-color: skyblue;
    }
    .profile {
    display: inline-block;
    padding: 7px 15px;
    font-size: 16px;
    font-weight: bold;
    color: #f3f4f6;
    background-color: darkblue;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
    box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
    transition: background-color 0.3s, box-shadow 0.3s, transform 0.2s;
    margin-top: 3vh;
}

.profile:hover {
    background-color: orange;
    box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.5);
    transform: translateY(-3px);
}

.prof{
    display: flex;
    flex-direction: row;
    justify-content: right;
}
  </style>
</head>
<body>
  <header>
    <!-- ヘッダー。ハンバーガーメニュー -->
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
      <div class="container-fluid">
          <a class="navbar-brand" href="#">
              <img src="{{ Storage::url('imgs/ロゴ.png') }}" alt="ロゴ">
              PostSol 〜不満からビジネスへ〜
          </a>
          
      </div>
    </nav>
  </header>

  <!-- メインコンテンツ -->
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('新規登録完了') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('ご登録ありがとうございます。以下のボタンからプロフィールを作成しましょう！') }}
                </div>
            </div>
        </div>
    </div>
    <div class="prof"><a href="/tops/{{ $user->id }}/create_profile" class="profile">プロフィール作成</a></div>
</div>

  <!-- フッター -->
  <footer>
    <p>&copy; 2024 PostSol. All rights reserved.</p>
  </footer>

  <!-- Bootstrap JavaScriptのCDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




