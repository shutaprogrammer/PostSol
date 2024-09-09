@extends('layouts.app_original')
@section('content')
    <section>
        <h1>プロフィール</h1>

        @if($user->img)
        <img src="{{ Storage::url('imgs/' .$user->img) }}" alt="">
        @endif
        <p>{{ $user->name }}</p>
        <p>{{ $user->birth }}, {{ $user->country }}, {{ $user->prefecture }}, {{ $user->city }}, {{ $user->job }}</p>
        <p>BM総獲得数:{{ $totalBookmarks }}、いいね総獲得数:{{ $totalLikes }}、保有BMコイン数:?</p>

    </section>
    <section>
        <h2>ブックマークした投稿</h2>
        <p>ブックマークした数:{{ $totalbookemarkedposts }}</p>

        @foreach ($bookmarkedPosts as $post)
    <div>
        <h3>{{ $post->content }}</h3>
    </div>
        <h5>{{ $post->category }}</h5>
        <h5>{{ $post->place }}</h5>
    @endforeach
    </section>
@endsection