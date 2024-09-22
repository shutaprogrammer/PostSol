@extends('layouts.app_original')
<head><link rel="stylesheet" href="{{ asset('css/posts.index.css') }}"></head>
@section('content')


<style>
    /* Twitter風のスタイル */
    .twitter__container {
        max-width: 600px;
        margin: 0 auto;
        font-size: 14px;
        border: 1px solid #000000;
        background-color: #ffffff;
    }
    .twitter__block {
        display: flex;
        padding: 10px;
        border-bottom: 1px solid #000000;
    }
    .twitter__block:last-child {
        border-bottom: none;
    }
    .twitter__profile {
        margin-right: 10px;
        height: 50px;
    }
    .twitter__profile img {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
    }
    .twitter__content {
        flex: 1;
    }
    .twitter__header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .twitter__name {
        font-weight: bold;
        color: #14171a;
    }
    .twitter__date {
        color: #657786;
        font-size: 12px;
    }
    .twitter__text {
        margin: 5px 0;
        color: #14171a;
        height: 100%;
    }
    .kateba{
        font-size: 12px;
    }
    .twitter__actions {
        display: flex;
        align-items: center;
        margin-top: 10px;
    }
    .twitter__actions button {
        background: none;
        border: none;
        cursor: pointer;
        color: #657786;
        font-size: 16px;
        margin-right: 20px;
    }
    .twitter__actions button:hover {
        color: #1da1f2;
    }
    .twitter__counts {
        color: #657786;
        font-size: 12px;
        margin-top: 1px;
        text-align: right;
    }
    .size {
        width: 48px;
        height: 48px;
        object-fit: cover;
        border-radius: 50%;
    }
    .custom-alert {
        margin-bottom: 15px;
    }
    /* フリーユーザーへの通知 */
    .free-user-notice {
        text-align: center;
        color: red;
        margin-top: 20px;
    }
    /* 通報ボタンのスタイル */
    .twitter__report-button {
        background-color: #ff4d4d; /* 赤色 */
        color: white;
        border: none;
        padding: 5px 10px;
        font-size: 12px;
        border-radius: 3px;
        cursor: pointer;
        position: absolute; /* 位置を調整可能に */
        bottom: 10px; /* ボックスの下からの距離 */
        right: 10px; /* ボックスの右からの距離 */
        display: inline-block; /* クリック範囲を調整 */
        text-decoration: none; /* アンカータグの下線を消す */
        z-index: 10; /* 通報ボタンを前面に表示 */
    }
    
    .twitter__block {
        position: relative; /* 通報ボタンを絶対配置するために必要 */
        padding: 10px;
        border-bottom: 1px solid #000000;
        background-color: #ffffff;
        z-index: 9;

    }
    /* 削除予定日と延長ボタン */
    .twitter__deletion-date {
        position: relative;
        font-size: 12px;
        color: #657786;
        display: flex;
        flex-direction: row;
        justify-content: center;
        z-index: 12;
        width: 80%;
        position: absolute;
        bottom: 10px;
        left: 0;

    }
    
    .twitter__deletion-date .btn-extend {
        background-color: #28a745; /* 緑色のボタン */
        color: #ffffff; /* ボタンの文字色 */
        border: none; /* ボタンの枠線を消す */
        padding: 5px 10px; /* ボタンの内側の余白 */
        font-size: 12px; /* ボタンの文字サイズ */
        border-radius: 3px; /* ボタンの角を丸くする */
        cursor: pointer; /* マウスカーソルをポインタにする */
        margin-left: 10px; /* 削除予定日との間隔 */
    }
    
    .twitter__deletion-date .btn-extend:hover {
        background-color: #218838; /* ホバー時の色 */
    }

    .twitter__actions{
        display: flex;
        justify-content: flex-end; /* 右寄せ */
        align-items: center;
        margin-top: 1px;
        text-align: right; /* アクションボタンを右寄せにする */
        width: 30vw;
        height: 2vh;
    }
    /* 共通のアクションボタンのスタイル */
    .twitter__actions button {
        background: none;
        border: none;
        cursor: pointer;
        color: #657786; /* デフォルトの色 */
        font-size: 16px;
        margin-right: 20px;
        outline: none; /* フォーカス時の境界線を消す */
    }
    
    /* ブックマークボタン */
    .twitter__actions .fa-bookmark {
        color: #657786; /* 未ブックマーク時のデフォルト色 */
    }
    
    /* ブックマーク済み */
    .twitter__actions .fa-bookmark.bookmarked {
        color: #1da1f2; /* ブックマーク済みの色（青） */
    }
    
    /* いいねボタン */
    .twitter__actions .fa-heart {
        color: #657786; /* 未いいね時のデフォルト色 */
    }
    
    /* いいね済み */
    .twitter__actions .fa-heart.liked {
        color: #e0245e; /* いいね済みの色（赤） */
    }
    
    /* ボタンホバー時のアニメーション */
    .twitter__actions button:hover .fa-bookmark,
    .twitter__actions button:hover .fa-heart {
        transform: scale(1.2); /* 拡大アニメーション */
        transition: transform 0.2s ease-in-out; /* なめらかなアニメーション */
    }

    .filter-form{
        margin-bottom: 5vh;
    }

    .con_haikei{
        /* padding: 10% 10%;
        background-color: black; */
    }

    .kaigyou{
        height: auto;
        width: 65vw;
        word-wrap: break-word; /* 長い単語を改行 */
        white-space: pre-wrap; /* 改行を保持しつつ、長いテキストを自動改行 */
    }
    h6{
    font-size: 8vw;
}
    .entyou{
        height: 3.7vh;
    }
    .iine{
        margin-top: 13px;
        margin-left: 5px;
    }
    .btn.btn-extend{
    }
    .kateact{
        height: 2vh;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        margin-bottom: 7vh;
    }
</style>



<!-- セッションメッセージの表示 -->
@if(session('alert_success'))
    <div class="alert alert-success custom-alert">
        {{ session('alert_success') }}
    </div>
@endif

@if(session('alert_error'))
    <div class="alert alert-danger custom-alert">
        {{ session('alert_error') }}
    </div>
@endif

<h6>投稿一覧</h6>
<!-- フィルターフォーム -->
<form action="{{ route('posts.index') }}" method="GET" class="filter-form">
    <div class="form-group">
        <label for="category">カテゴリーを選択：</label>
        <select name="category" id="category" class="form-control" onchange="this.form.submit()">
            <option value="">すべてのカテゴリー</option>
            @foreach($types as $type)
            <option value="{{ $type }}" {{ request('category')  == $type ? 'selected' : ''}}>
                {{ $type }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="keyword">キーワードで検索：</label>
        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="キーワードを入力">
        <input type="submit" value="検索" class="btn btn-primary">
    </div>

    <div class="form-group">
        <label for="arrange">並び替え：</label>
        <select name="arrange" id="arrange" class="form-control" onchange="this.form.submit()">
            <option value="">選択してください</option>
            @foreach($orders as $order)
            <option value="{{ $order }}" {{ request('arrange') == $order ? 'selected' : ''}}>
                {{ $order }}
            </option>
            @endforeach
        </select>
    </div>
</form>

<div class="con_haikei">
    <div class="twitter__container">
    @if(!$freeuser)
        @foreach ($posts as $post)
        <div class="twitter__block">
                <!-- プロフィール画像 -->
                <div class="twitter__profile">
                    @if($post->user->img)
                        <img src="{{ Storage::url('imgs/' .$post->user->img) }}" alt="" class="size">
                    @else
                        <!-- デフォルトのプロフィール画像 -->
                        <img src="/path/to/default/profile/image.png" alt="" class="size">
                    @endif
                </div>
                <!-- 投稿内容 -->
            <div class="twitter__content">
                <!-- ヘッダー（名前と日付） -->
                <div class="twitter__header">
                    <span class="twitter__name">{{ $post->user->name }}</span>
                    <span class="twitter__date">{{ $post->created_at->format('Y年m月d日 H:i') }}</span>
                </div>
                <!-- テキスト -->
                <div class="twitter__text kaigyou">{{ $post->content }}</div>
            <div class="kateact">
                <!-- カテゴリーと場所 -->
                <div class="twitter__text kateba">
                    <strong>#</strong> {{ $post->category }}   
                    <strong>@</strong> {{ $post->place }}
                </div>
                <!-- アクションボタン -->
                <div class="actdura">
                <div class="twitter__actions">
                    <!-- ブックマークボタン -->
                    @if(!App\Models\Bookmark::where('user_id', Auth::id())->where('post_id', $post->id)->exists())
                    <!-- モーダルを表示するボタン -->
                    <button type="button" data-bs-toggle="modal" data-bs-target="#bookmarkModal-{{ $post->id }}">
                        <i class="fas fa-bookmark"></i> <!-- 未ブックマーク時 -->
                    </button>
                    @else
                    <button disabled>
                        <i class="fas fa-bookmark bookmarked"></i> <!-- ブックマーク済み時 -->
                    </button>
                    @endif

                    <!-- いいねボタン -->
                    @if(App\Models\Like::where('user_id', Auth::id())->where('post_id', $post->id)->exists())
                    <form action="{{ route('unlike', $post) }}" method="POST" class="iine">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            <i class="fas fa-heart liked"></i> <!-- いいね済みの時の赤色のアイコン -->
                        </button>
                    </form>
                    @else
                        <form action="{{ route('like', $post) }}" method="POST" class="iine">
                            @csrf
                            <button type="submit">
                                <i class="far fa-heart"></i> <!-- いいねしていない時のアイコン -->
                            </button>
                        </form>
                    @endif
                </div>
                <!-- カウント表示 -->
                <div class="twitter__counts">
                    <span id="bookmark-count-{{ $post->id }}">{{ $post->bookmarks_count }} ブックマーク</span> ・ 
                    <span>{{ $post->likes_count }} いいね</span>
                </div>
                </div>
            </div>
                <!-- 通報リンク -->
                <div class="twitter__text">
                    <a href="{{ route('reports.create', ['post' => $post->id]) }}" class="twitter__report-button">通報する</a>
                </div>
                <!-- アラートメッセージ（投稿に関連付け） -->
                @if(session('alert') && session('alert')['post_id'] == $post->id)
                    <div class="alert alert-danger custom-alert">
                        <strong>注意:</strong> {{ session('alert')['message'] }}
                    </div>
                @endif
            </div>
            <!-- 削除予定日と延長ボタン -->
            <div class="twitter__deletion-date">
                削除予定日: {{ $post->deletion_date->format('Y年m月d日 H:i') }}
                <div class="entyou">
                    @if ($post->user_id === Auth::id())
                    <form action="{{ route('posts.extend', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-extend">延長する</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>

            <!-- ブックマークのモーダル -->
            <div class="modal fade" id="bookmarkModal-{{ $post->id }}" tabindex="-1" aria-labelledby="bookmarkModalLabel-{{ $post->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" style="color: black" id="bookmarkModalLabel-{{ $post->id }}">ブックマークの確認</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                        </div>
                        <div class="modal-body" style="color: black">
                            ⚠️ ブックマークは二度と解除できません。それでもよろしいですか？
                        </div>
                        <div class="modal-footer">
                            <form id="bookmarkForm-{{ $post->id }}" action="{{ route('bookmark', $post) }}" method="POST">
                                @csrf
                                <button type="button" class="btn btn-primary bookmark-submit-button" data-id="{{ $post->id }}">はい</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else

    {{-- ここからがフリーユーザーに対しての記述 --}}
        @foreach ($posts as $post)
            <div class="twitter__block">
                <!-- プロフィール画像 -->
                <div class="twitter__profile">
                    @if($post->user->img)
                        <img src="{{ Storage::url('imgs/' .$post->user->img) }}" alt="" class="size">
                    @else
                        <!-- デフォルトのプロフィール画像 -->
                        <img src="/path/to/default/profile/image.png" alt="" class="size">
                    @endif
                </div>
                <!-- 投稿内容 -->
                <div class="twitter__content">
                    <!-- ヘッダー（名前と日付） -->
                    <div class="twitter__header">
                        <span class="twitter__name">{{ $post->user->name }}</span>
                        <span class="twitter__date">{{ $post->created_at->format('Y年m月d日 H:i') }}</span>
                    </div>
                    <!-- テキスト -->
                    <div class="twitter__text">{{ $post->content }}</div>
                < class="kateact">
                    <!-- カテゴリーと場所 -->
                    <div class="twitter__text kateba">
                        <strong>#</strong> {{ $post->category }}   
                        <strong>@</strong> {{ $post->place }}
                    </div>
                    <div class="actdura">
                    <!-- アクションボタン -->
                    <div class="twitter__actions">
                        <!-- ブックマークボタン -->
                        @if(!App\Models\Bookmark::where('user_id', Auth::id())->where('post_id', $post->id)->exists())
                            <!-- モーダルを表示するボタン -->
                            <button type="button" data-bs-toggle="modal" data-bs-target="#bookmarkModal-{{ $post->id }}">
                                <i class="fas fa-bookmark"></i>
                            </button>
                        @else
                            <button disabled>
                                <i class="fas fa-bookmark"></i>
                            </button>
                        @endif
                        <!-- いいねボタン -->
                        @if(App\Models\Like::where('user_id', Auth::id())->where('post_id', $post->id)->exists())
                            <form action="{{ route('unlike', $post) }}" method="POST" class="iine">
                                @csrf
                                @method('DELETE')
                                <button type="submit"><i class="fas fa-heart"></i></button>
                            </form>
                        @else
                            <form action="{{ route('like', $post) }}" method="POST" class="iine">
                                @csrf
                                <button type="submit"><i class="far fa-heart"></i></button>
                            </form>
                        @endif
                    </div>
                    <!-- カウント表示 -->
                    <div class="twitter__counts">
                        <span>{{ $post->bookmarks_count }} ブックマーク</span> ・ 
                        <span>{{ $post->likes_count }} いいね</span>
                    </div>
                    </div>
                </div>
                    <!-- 通報リンク -->
                    <div class="twitter__text">
                        <a href="{{ route('reports.create', ['post' => $post->id]) }}" class="twitter__report-button">通報する</a>
                    </div>
                    <!-- アラートメッセージ（投稿に関連付け） -->
                    @if(session('alert') && session('alert')['post_id'] == $post->id)
                        <div class="alert alert-danger custom-alert">
                            <strong>注意:</strong> {{ session('alert')['message'] }}
                        </div>
                    @endif
                </div>
                <!-- 削除予定日と延長ボタン -->
                <div class="twitter__deletion-date">
                    削除予定日: {{ $post->deletion_date->format('Y年m月d日 H:i') }}
                    <div class="entyou">
                        @if ($post->user_id === Auth::id())
                        <form action="{{ route('posts.extend', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-extend">延長する</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

            <!-- ブックマークボタン -->
        <div class="d-inline">
            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#freeUserModal">
                ☆
            </button>
            <div>FreeユーザーはBM使用不可</div>

        <!-- フリーユーザーへの通知 -->
        <div class="free-user-notice">
            Freeのユーザーは5つまでしか閲覧できません。サブスク登録をして全ての投稿を見てみましょう。
        </div>

        <!-- フリーユーザー用のモーダル -->
        <div class="modal fade" id="freeUserModal" tabindex="-1" aria-labelledby="freeUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: black" id="freeUserModalLabel">使用制限のお知らせ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                    </div>
                    <div class="modal-body" style="color: black">
                        Freeユーザーはブックマーク機能を利用できません。<br>サブスク購入ですべての機能が利用可能になります。
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('mypages.subscription1') }}" class="btn btn-primary">サブスク購入へ</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
</div>

<script>
    window.csrfToken = '{{ csrf_token() }}';
</script>

<script src="{{ asset('js/posts.index.js') }}"></script>
@endsection