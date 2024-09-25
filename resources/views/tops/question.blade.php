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
  <link rel="stylesheet" href="./assets/css/reset.css">
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
    .each-q{
        margin-bottom: 15px;
    }
    label {
    display: block;
    margin-bottom: 5px; /* labelとinputの間にスペースを作成 */
    }
    
    input, textarea {
        width: 100%; /* 入力フィールドを幅いっぱいにする（任意） */
        padding: 8px;
        box-sizing: border-box; /* パディングを含めた幅計算にする */
    }
    button {
    background-color: #4CAF50; /* 緑色 */
    color: white; /* テキストを白に */
    border: none; /* ボーダーをなくす */
    padding: 10px 20px; /* パディングを追加 */
    text-align: center; /* テキストを中央寄せ */
    font-size: 16px; /* フォントサイズを調整 */
    border-radius: 5px; /* ボタンの角を丸くする */
    cursor: pointer; /* ホバー時にカーソルをポインタに */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* 軽いシャドウを追加 */
    transition: background-color 0.3s ease; /* 背景色の変化をスムーズに */
    }
    
    button:hover {
        background-color: #45a049; /* ホバー時の色 */
    }
    .button-container{
        text-align: right;
    }
    .strong{
        font-size: 20px;
    }
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
    body {
        font-family: 'Roboto', system-ui, -apple-system, "Segoe UI", sans-serif;
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
          
  </header>

  <!-- メインコンテンツ -->
  <div class="container mt-5">
    <p><strong>アンケートにご協力ください。</strong>以下の情報は個人情報保護法に基づき適切に管理され、不当に公開・利用されることはありません。<a href="">PostSol プライバシーポリシー</a></p>
    
    <!-- ここにidを追加します -->
    <form id="myForm" action="{{ route('questions.store') }}" method="POST">
        @csrf
        <div class="each-q">
            <label for="job">職業(必須)</label>
            <input type="text" placeholder="あなたの職業を入力してください" id="job" name="job">
        </div>
        <div class="each-q">
            <label for="marital">未既婚(必須)</label>
            <input type="text" placeholder="未婚または既婚と入力してください" id="marital" name="marital">
        </div>
        <div class="each-q">
            <label for="children">子供の人数(必須)</label>
            <input type="text" placeholder="子供の人数を入力してください" id="children" name="children">
        </div>
        <div class="each-q">
            <label for="salary">世帯年収(必須)</label>
            <input type="text" placeholder="世帯年収を入力してください" id="income" name="salary">
        </div>
        <div class="each-q">
            <label for="business">今後行いたいビジネスはなんですか？(必須)</label>
            <textarea id="business" cols="30" rows="10" placeholder="今後行いたいビジネスがあれば入力してください" name="business"></textarea>
        </div>

        <div class="button-container">
            <button type="submit">アンケートを送信</button>
        </div>
    </form>

    <script>
        // フォーム送信前にバリデーションを実行
        document.getElementById('myForm').addEventListener('submit', function(event) {
            const job = document.getElementById('job').value;
            const marital = document.getElementById('marital').value;
            const children = document.getElementById('children').value;
            const salary = document.getElementById('income').value;
            const business = document.getElementById('business').value;

            // 入力内容を確認する
            if (!job || !marital || !children || !salary || !business) {
                event.preventDefault();  // フォームの送信を防ぐ
                alert('すべてのフィールドを正しく入力してください。');
            }
        });
    </script>


  </div>

  <!-- フッター -->
  <footer>
    <p>&copy; 2024 PostSol. All rights reserved.</p>
  </footer>

  <!-- Bootstrap JavaScriptのCDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
