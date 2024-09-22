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
        position: fixed;
        top: 0;
        z-index: 50;
        width: 100%;
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

    header{
      margin-bottom: 15vh;
    }
  </style>
</head>
<body class="postsol-layout">
  <header>
    <!-- ヘッダー。ハンバーガーメニュー -->
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
      <div class="container-fluid">
          <a class="navbar-brand" href="#">
              <img src="{{ Storage::url('imgs/ロゴ.png') }}" alt="ロゴ">
              PostSol 〜不満からビジネスへ〜
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('posts.index') }}">投稿一覧表示</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('posts.create') }}">新規投稿作成</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('mypages.show') }}">マイページ</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('mypages.edit', ['id' => Auth::user()->id]) }}">プロフィール編集</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('mypages.subscription1') }}">サブスク登録</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('bmcoin.index1') }}">コイン購入</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('mypages.exchange') }}">コイン換金 </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('rankings.post') }}">投稿ランキング </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('rankings.user') }}">ユーザーランキング </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.form') }}">お問い合わせ </a>
                  </li>
                  <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }} "
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                  </li>
              </ul>
          </div>
      </div>
    </nav>
  </header>

  <!-- メインコンテンツ -->
  <div class="container mt-5">
    @yield('content')
  </div>

  <!-- フッター -->
  <footer>
    <p>&copy; 2024 PostSol. All rights reserved.</p>
  </footer>

  <!-- Bootstrap JavaScriptのCDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>