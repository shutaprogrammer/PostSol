@extends('layouts.app_original')
@section('content')

<style>
    .carousel-item img {
    width: 100%; /* 横幅は100%でコンテナにフィット */
    max-height: 200px; /* 縦の長さを200pxに制限 */
    object-fit: cover; /* コンテナ内で収めつつ、余分な部分はカット */
}

    .fuchidori{
    text-shadow:
    1px 1px 0px #000,
    -1px 1px 0px #000,
    1px -1px 0px #000,
    -1px -1px 0px #000;
    }

    /* 左の三角ボタン */
    .carousel-control-prev-icon {
        background-color: rgba(0, 0, 0, 0.5); /* 黒の半透明背景 */
        border-radius: 50%; /* ボタンを丸くする */
    }

    /* 右の三角ボタン */
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5); /* 黒の半透明背景 */
        border-radius: 50%; /* ボタンを丸くする */
    }

/* プロフィールセクション */
.profile-section {
    background-color: white;
    padding: 3rem;
    border-radius: 0.375rem;
    box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.4);
}

/* ブックマークした投稿セクション */
.bookmarked-posts-section {
    background-color: #212529;
    color: #ffffff;
    padding: 3rem;
    border-radius: 0.375rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.amounts{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.badge{
    width: 35vw;
    text-align: center;
    font-size: 15px;
}

h6{
    font-size: 8vw;
}

.twitter__profile img {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
    }

.toukousya{
    display: flex;
    flex-direction: row;
}

.twitter__header{
    height: auto;
    margin-top: 2vh;
}

.kateba{
    display: flex;
    flex-direction: row;
    font-size: 13px;
}

.message-icon {
    padding: 5px;
    border: 1px solid black;
    border-radius: 5px;
    background-color: rgb(199, 198, 198);
    width: 120px;
    height: 30px;
    margin: 10px 0 0 20vw;
    padding-bottom: 5px;
    font-size: 15px;
}

.unread-border {
    border-color: red;
    background-color: red;
}
.titledm{
    display: flex;
    flex-direction: row;
}

</style>
    <div class="titledm">
        <h6>マイページ</h6>
        {{-- 未読DMあれば赤適用 --}}
        <div class="message-icon @if($unreadMessagesCount > 0) unread-border @endif">
            未読DM数：{{ $unreadMessagesCount }}
        </div>
    </div>
    
    <!-- プロフィールセクション -->
    <section class="container mt-5 bg-light p-5 shadow-sm rounded">
        <h1 class="text-center mb-4 prof">プロフィール</h1>

        {{-- プロフィール画像があれば表示、なければデフォルトの画像表示 --}}
        <div class="text-center mb-4">
            <img src="{{ $user->img ? Storage::url('imgs/' . $user->img) : asset('images/default-profile.png') }}" alt="" class="rounded-circle shadow" style="width: 200px; height: 200px; object-fit: cover;">
        </div>
        
        <div class="text-center mb-4">
            <p class="h4">{{ $user->name }}</p>

            <p>{{ $user->birth }}生まれ　{{ $user->country }} {{ $user->prefecture }} {{ $user->city }}在住</p>
            <hr>
            <p class="amounts">ブックマーク: <span class="badge bg-info">{{ $totalBookmarks }}</span> いいね: <span class="badge bg-success">{{ $totalLikes }}</span> 保有コイン: <span class="badge bg-warning">{{ $totalCoins }}</span> ステータス： <span class="badge bg-primary">{{ $status->status }}</span></p>
            @if($remainingTime)
            <p>Trial期間の残り時間: {{ $remainingTime }}</p>
            @endif
            @if($paidRemainingTime)
            <p>Primeの残り期間: <br> {{ $paidRemainingTime }}</p>
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
                      <div class="toukousya">
                        <!-- プロフィール画像 -->
                        <div class="twitter__profile">
                            @if($post->user->img)
                                <img src="{{ Storage::url('imgs/' .$post->user->img) }}" alt="" class="size">
                            @else
                                <!-- デフォルトのプロフィール画像 -->
                                <img src="/path/to/default/profile/image.png" alt="" class="size">
                            @endif
                        </div>
                        <!-- 名前 -->
                        <div class="twitter__header">
                            <span class="twitter__name">{{ $post->user->name }}　</span>
                            <span class="twitter__date">{{ $post->created_at->format('Y年m月d日') }}</span>
                        </div>
                      </div>
                        <h5 class="card-title">{{ $post->content }}</h5>
                       <div class="kateba">
                        <p class="card-text"># {{ $post->category }}　</p>
                        <p class="card-text">@ {{ $post->place }}</p>
                       </div>
                        <!-- DMボタン -->
                        <form action="{{ route('conversations.create')  }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_two_id" value="{{ $post->user_id }}">
                                <button type="submit" class="btn btn-primary">{{ $post->user->name }} にDMを送る</button>
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
                        <h5 class="card-title">Freeのため閲覧不可</h5>

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
                    <div class="carousel-caption fuchidori">
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

    {{-- Gemini
    <form action="{{route('entry')}}" method="post">
        @csrf
        <textarea name="toGeminiText" autofocus>@isset($result['task']){{$result['task']}}@endisset </textarea>
        <button type="submit">send</button>
    </form>
    
    <hr>
    
    @isset($result)
    <p>{!!$result['content']!!}</p>
    @endisset --}}
@endsection
