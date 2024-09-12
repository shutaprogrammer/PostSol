@extends('layouts.app_original')
@section('content')
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