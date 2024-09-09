@extends('layouts.app_original')
@section('content')
<a href="{{ route('mypages.subscription1') }}">サブスクリプション登録１viewへ</a>
<a href="{{ route('posts.index') }}">投稿一覧表示画面へ</a>
    <section>
        <h1>プロフィール</h1>
        {{-- <p>{{ $user->name }}</p>
        <p>{{ $user->birth }}, {{ $user->country }}, {{ $user->prefecture }}, {{ $user->city }}, {{ $user->job }}</p> --}}
        <p>BM総獲得数:?、いいね総獲得数:?、保有BMコイン数:?</p>
    </section>
    <section>
        <h2>ブックマークした投稿</h2>
        <p>ブックマークした数:?</p>
        
    </section>
@endsection