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
        position: relative;
        z-index: 3;
        margin-top: 8vh;
        bottom: 0;
        width: 100%;
    }

    header{
      margin-bottom: 15vh;
    }

    /* 以下メインコンテンツ用css */
    .messages-list{
        width: 96%;
        margin-bottom: 27vh;
    }
    .waku {
        border: 1px solid black;
        margin: 2vh 2vw 0 0;
        max-width: 80%; /* 最大幅を設定 */
        min-width: 20%; /* 最小幅を設定 */
        border-radius: 5px; /* 角を丸める */
        clear: both; /* 並びをクリアして縦に表示 */
    }
    .wakumine {
        border: 1px solid black;
        margin: 2vh 0 0 2vw;
        max-width: 80%; /* 最大幅を設定 */
        min-width: 20%; /* 最小幅を設定 */
        border-radius: 5px; /* 角を丸める */
        clear: both; /* 並びをクリアして縦に表示 */
        text-align: right; /* 右寄せにする */
        margin-left: auto; /* 左側のマージンを自動にして右寄せ */
    }
    .message-item {
        margin: 5px;
        width: auto; /* 自動的に幅を調整 */
    }
    .mine {
        text-align: right;
        background-color: #e0f7fa; /* 自分のメッセージの背景色 */
    }
    .other {
        text-align: left;
        background-color: #ffe0b2; /* 相手のメッセージの背景色 */
    }
    .naiyou {
        word-wrap: break-word; /* 長い単語がある場合に折り返す */
        margin: 0;
    }
    .name{
        margin: 4px 0 0 0;
    }
    .jibuntime{
        margin-left: 52vw;
    }
    .aitetime{
        margin-left: 3vw;
    }
    .container{
        position: relative;
    }
    .sousinwaku{
        position: fixed;
        bottom: 0;
        z-index: 2;
        width: 100%;
        height: 23vh;
        background-color: black;
    }
    .sousinb{
        margin: 5px 0 5px 78vw;
        position: absolute;
        bottom: 25vh;

    }
    form{
        height: 25vh;
        position: relative;
    }
    hr{
        margin-top: 20px;
    }
    .size {
        width: 30px;
        height: 30px;
        object-fit: cover;
        border-radius: 50%;
        margin: 2px 3px 2px 3px;
    }
    .imgname{
        display: flex;
        flex-direction: row;
    }
    .myimgname{
        display: flex;
        flex-direction: row;
        margin-left: 50vw;
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
                    <a class="nav-link" href="{{ route('messages.inbox') }}">DM </a>
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
    {{-- メインコンテンツ --}}
    <div class="container" style="margin-bottom: 100px;" >
        <h2>DM</h2>

        <hr>
        <!-- メッセージ一覧表示 -->
        <div class="messages-list">
            @foreach ($messages as $message)
            
            @if(Auth::user()->id == $message->sender_id)
                <div class="wakumine">
                    <div class="message-item mine ">
                        <div class="myimgname">
                            <!-- プロフィール画像 -->
                            <p class="name">{{ $message->sender->name }}</p>
                            <div class="twitter__profile">
                                <img src="{{ Storage::url('imgs/' . Auth::user()->img) }}" alt="" class="size">
                            </div>
                        </div>
                        <p class="naiyou">{{ $message->message }}</p> 
                    </div>
                </div>
                <span class="jibuntime">{{ $message->created_at->format('Y-m-d H:i') }}</span>
            @else
                <div class="waku">
                    <div class="message-item other ">
                        <div class="imgname">
                            <!-- プロフィール画像 -->
                            <div class="twitter__profile">
                                <img src="{{ Storage::url('imgs/' .$message->sender->img) }}" alt="" class="size">
                            </div>
                            <p class="name">{{ $message->sender->name }}</p>
                        </div>
                        <p class="naiyou">{{ $message->message }}</p> 
                    </div>

                </div>
                <span class="aitetime">{{ $message->created_at->format('Y-m-d H:i') }}</span>
            
            @endif
            @endforeach
        </div>

        <!-- メッセージ送信フォーム -->
      <div class="sousinwaku">
        <hr>
        <form action="{{ route('messages.store', compact('conversationId'))}}" method="POST">
            @csrf
            <input type="hidden" name="conversation" value="{{ $conversationId }}">
            <div class="form-group mt-4">
                <textarea name="body" class="form-control" rows="3" placeholder="メッセージを入力してください" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3 sousinb">送信</button>
        </form>
      </div>
    </div>

<!-- Bootstrap JavaScriptのCDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

