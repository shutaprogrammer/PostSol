@extends('layouts.app_original')

@section('content')
    <style>
        /* 全体のセクションスタイル */
        section {
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        /* タイトル */
        h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 1rem;
            text-align: center;
        }

        /* 段落スタイル */
        p {
            font-size: 1rem;
            color: #666;
            line-height: 1.6;
        }

        /* リストスタイル */
        ul {
            list-style-type: disc;
            padding-left: 1.5rem;
        }

        li {
            margin-bottom: 0.5rem;
            font-size: 1rem;
            color: #555;
        }

        /* ボタンスタイル */
        button {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            margin: 0 auto;
        }

        button:hover {
            background-color: #0056b3;
        }

        button a {
            color: #fff;
            text-decoration: none;
        }

        button a:hover {
            text-decoration: none;
        }
    </style>

    <section>
        <h1>サブスクリプション登録</h1>
        <p>現在のあなたのステータス: {{ $status->status }}</p>
    </section>

    <section>
        <p>本サブスクの概要は以下の通りです。</p>
        <ul>
            <li>利用可能期間：購入完了から30日後</li>
            <li>ブックマーク機能の使用が可能になる</li>
            <li>投稿一覧表示画面における閲覧可能数の制限が無制限となる</li>
            <li>BMコイン100コイン(BM10回分)が付与される</li>
        </ul>
    </section>

    <p>サブスク登録をご希望の方は、以下のボタンからサブスク登録画面へ遷移して、クレジットカード情報入力・決済をしてください。</p>
    
    <button><a href="{{ route('mypages.subscription2') }}">サブスク登録画面へ進む</a></button>
@endsection