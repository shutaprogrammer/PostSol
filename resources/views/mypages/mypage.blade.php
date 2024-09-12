{{-- @extends('layouts.app_original')
@section('content')
    <section>
        <h1>プロフィール</h1>

        @if($user->img)
        <img src="{{ Storage::url('imgs/' .$user->img) }}" alt="">
        @endif
        <p>{{ $user->name }}</p>
        <p>{{ $user->birth }}, {{ $user->country }}, {{ $user->prefecture }}, {{ $user->city }}, {{ $user->job }}</p>
        <p>BM総獲得数:{{ $totalBookmarks }}、いいね総獲得数:{{ $totalLikes }}、保有BMコイン数:{{ $totalCoins }}、あなたのステータス：{{ $status->status }}</p>

        <a href="{{ route('mypages.edit', ['id' => $user->id]) }}" class="btn btn-primary">編集</a>
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
@endsection --}}

@extends('layouts.app_original')
@section('content')
    <!-- プロフィールセクション -->
    <section class="container mt-5 bg-light p-5 shadow-sm rounded">
        <h1 class="text-center mb-4">プロフィール</h1>

        @if($user->img)
        <div class="text-center mb-4">
            <img src="{{ Storage::url('imgs/' .$user->img) }}" alt="" class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
        </div>
        @endif
        <div class="text-center mb-4">
            <p class="h4">{{ $user->name }}</p>
            <p>{{ $user->birth }}年生まれ　{{ $user->country }}　{{ $user->prefecture }}　{{ $user->city }}出身　{{ $user->job }}</p>
            <p>BM総獲得数: <span class="badge bg-info">{{ $totalBookmarks }}　</span>　いいね総獲得数: <span class="badge bg-success">{{ $totalLikes }}　</span>　保有BMコイン数: <span class="badge bg-warning">{{ $totalCoins }}　</span>　あなたのステータス： <span class="badge bg-primary">{{ $status->status }}　</span></p>
            <a href="{{ route('mypages.edit', ['id' => $user->id]) }}" class="btn btn-primary mt-3">プロフィールを編集</a>
        </div>
    </section>

    <!-- ブックマークした投稿セクション -->
    <section class="container mt-5 bg-dark text-white p-5 shadow rounded">
        <h2 class="mb-4">ブックマークした投稿</h2>
        <p>ブックマークした数: <span class="badge bg-secondary">{{ $totalbookemarkedposts }}</span></p>
    @if(!$freeuser)
        <div class="row">
        @foreach ($bookmarkedPosts as $post)
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow">
                    <div class="card-body text-dark"> <!-- カード内はデフォルトの文字色に戻す -->
                        <h5 class="card-title">{{ $post->content }}</h5>
                        <p class="card-text"><strong>カテゴリ: </strong>{{ $post->category }}</p>
                        <p class="card-text"><strong>場所: </strong>{{ $post->place }}</p>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    @else
        <div class="row">
            @foreach ($bookmarkedPosts as $post)
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow">
                        <div class="card-body text-dark"> <!-- カード内はデフォルトの文字色に戻す -->
                            <h5 class="card-title">ステータス：Freeのため閲覧不可</h5>
                            <p class="card-text"><strong>カテゴリ: </strong></p>
                            <p class="card-text"><strong>場所: </strong></p>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
    @endif

    </section>
@endsection