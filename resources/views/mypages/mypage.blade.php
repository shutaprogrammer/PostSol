@extends('layouts.app_original')
@section('content')
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </head>

<style>
    .carousel-item img {
    width: 100%; /* 横幅は100%でコンテナにフィット */
    max-height: 200px; /* 縦の長さを200pxに制限 */
    object-fit: cover; /* コンテナ内で収めつつ、余分な部分はカット */
}

/* プロフィールセクション */
.profile-section {
    background-color: #f8f9fa;
    padding: 3rem;
    border-radius: 0.375rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

/* ブックマークした投稿セクション */
.bookmarked-posts-section {
    background-color: #212529;
    color: #ffffff;
    padding: 3rem;
    border-radius: 0.375rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

</style>

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
            <p>BM総獲得数: <span class="badge bg-info">{{ $totalBookmarks }}</span> いいね総獲得数: <span class="badge bg-success">{{ $totalLikes }}</span> 保有BMコイン数: <span class="badge bg-warning">{{ $totalCoins }}</span> あなたのステータス： <span class="badge bg-primary">{{ $status->status }}</span></p>
            @if($remainingTime)
            <p>Trial期間の残り時間: {{ $remainingTime }}</p>
            @endif
            @if($paidRemainingTime)
            <p>Paid Memberの残り期間: {{ $paidRemainingTime }}</p>
            @endif
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
                    <div class="card-body text-dark">
                        <h5 class="card-title">{{ $post->content }}</h5>
                        <p class="card-text"><strong>カテゴリ: </strong>{{ $post->category }}</p>
                        <p class="card-text"><strong>場所: </strong>{{ $post->place }}</p>
                        <!-- DMボタン -->
                        <form action="{{ route('conversations.create')  }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_two_id" value="{{ $post->user_id }}">
                                <button type="submit" class="btn btn-primary">DMを送る</button>
                            </form>
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
                    <div class="card-body text-dark">
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

    <!-- 広告掲載欄 -->
    <section class="container mt-5 mb-5">
        <div id="adsCarousel" class="carousel slide" data-bs-ride="carousel">
            <!-- インジケーター -->
            <ol class="carousel-indicators">
                @foreach ($ads as $index => $ad)
                    <li data-bs-target="#adsCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>

            <!-- 広告スライド -->
            <div class="carousel-inner">
                @foreach ($ads as $index => $ad)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ Storage::url($ad->image) }}" class="d-block mx-auto" alt="{{ $ad->title }}" style="max-height: 200px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $ad->title }}</h5>
                        <p>{{ $ad->description }}</p>
                        <a href="{{ $ad->link }}" class="btn btn-primary" target="_blank">詳しくはこちら</a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- コントロールボタン -->
            <a class="carousel-control-prev" href="#adsCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">前へ</span>
            </a>
            <a class="carousel-control-next" href="#adsCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">次へ</span>
            </a>
        </div>
    </section>
@endsection
