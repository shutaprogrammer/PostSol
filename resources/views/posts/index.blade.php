{{-- @extends('layouts.app_original')
@section('content')

<style>
    .size {
        widows: 100px;
        height: 100px;
    }
</style>

<div>
    @foreach ($posts as $post)
    @if($post->user->img)
    <img src="{{ Storage::url('imgs/' .$post->user->img) }}" alt="" class="size">
    @endif
    <p>{{ $post->user->name }}</p>
    <div>
        <h3>{{ $post->content }}</h3>
    </div>
        <h5>{{ $post->category }}</h5>
        <h5>{{ $post->place }}</h5>

        @if(App\Models\Bookmark::where('user_id', Auth::id())->where('post_id', $post->id)->exists())
        <form action="{{ route('unbookmark', $post) }}" method="POST" style="display: inline">
            @csrf
            @method('DELETE')
            <button type="submit">★</button>
        </form>
        @else
        <form action="{{ route('bookmark', $post) }}" method="POST" style="display: inline">
            @csrf
            <button type="submit">☆</button>
        </form>
        @endif

        @if(App\Models\Like::where('user_id', Auth::id())->where('post_id', $post->id)->exists())
        <form action="{{ route('unlike', $post) }}" method="POST" style="display: inline">
            @csrf
            @method('DELETE')
            <button type="submit">💖</button>
        </form>
        @else
        <form action="{{ route('like', $post) }}" method="POST" style="display: inline">
            @csrf
            <button type="submit">💔</button>
        </form>
        @endif
        <p>{{ $post->bookmarks_count }}ブックマーク</p>
        <p>{{ $post->likes_count }} いいね</p>
    @endforeach
</div>

@endsection --}}

@extends('layouts.app_original')
@section('content')

<style>
    .size {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
    }
    .custom-alert {
        margin-bottom: 15px; /* 他の要素とのスペースを確保 */
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
    <form action="{{ route('posts.index') }}" method="GET">
        <label for="category">カテゴリーを選択：</label>
        <select name="category" id="category" onchange="this.form.submit()">
            <option value="">すべてのカテゴリー</option>
            @foreach($types as $type)
            <option value="{{ $type }}" {{ request('category')  == $type ? 'selected' : ''}}>
            {{ $type }}
            </option>
            @endforeach
        </select>
    </form>

    <form action="{{ route('posts.index') }}" method="GET">
        <input type="text" name="keyword">
        <input type="submit" value="検索">
    </form>

    <form action="{{ route('posts.index') }}" method="GET">
        <label for="arrange">並び替え</label>
        <select name="arrange" id="arrange" onchange="this.form.submit()">
            <option value=""></option>
            @foreach($orders as $order)
            <option value="{{ $order }}" {{ request('arrange') == $order ? 'selected' : ''}}>
                {{ $order }}
            </option>
            @endforeach
        </select>
    </form>

@if(!$freeuser)
<div class="container mt-5 bg-dark text-white p-5 shadow rounded">
    @foreach ($posts as $post)
    <div class="card bg-secondary text-white mb-5 shadow">
        <div class="card-body">
            <!-- 投稿者の画像 -->
            @if($post->user->img)
            <div class="text-center mb-3">
                <img src="{{ Storage::url('imgs/' .$post->user->img) }}" alt="" class="size shadow">
            </div>
            @endif

            <!-- 投稿者の名前 -->
            <p class="text-center h4">{{ $post->user->name }}</p>

            <!-- 投稿内容 -->
            <div class="bg-dark p-4 rounded shadow-sm mb-2">
                <h3 class="text-light">{{ $post->content }}</h3>
                <div>
                    <p><a href="{{ route('reports.create', ['post' => $post->id]) }}">通報する</a></p>
                </div>
            </div>

            <!-- カテゴリーと場所 -->
            <h5><strong>カテゴリ:</strong> {{ $post->category }}</h5>
            <h5><strong>場所:</strong> {{ $post->place }}</h5>

            <!-- アラートメッセージ（投稿に関連付け） -->
            @if(session('alert') && session('alert')['post_id'] == $post->id)
                <div class="alert alert-danger custom-alert">
                    <strong>注意:</strong> {{ session('alert')['message'] }}
                </div>
            @endif

            {{-- ブックマーク --}}
            <div class="d-inline">
                @if(!App\Models\Bookmark::where('user_id', Auth::id())->where('post_id', $post->id)->exists())
                    <!-- ボタンをクリックするとモーダルを表示 -->
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#bookmarkModal-{{ $post->id }}">
                        ☆
                    </button>
                @else
                    <button class="btn btn-warning" disabled>★</button>
                @endif
            </div>
            
            <!-- ブックマークのモーダル -->
            <div class="modal fade" id="bookmarkModal-{{ $post->id }}" tabindex="-1" aria-labelledby="bookmarkModalLabel-{{ $post->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" style="color: black" id="bookmarkModalLabel-{{ $post->id }}">ブックマークの確認</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="color: black">
                            ⚠警告：ブックマークは二度と解除できません。それでもやりますか？
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('bookmark', $post) }}" method="POST" style="display: inline">
                                @csrf
                                <button type="submit" class="btn btn-primary">はい</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- いいねボタン -->
            <div class="d-inline ms-3">
                @if(App\Models\Like::where('user_id', Auth::id())->where('post_id', $post->id)->exists())
                <form action="{{ route('unlike', $post) }}" method="POST" style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">💖</button>
                </form>
                @else
                <form action="{{ route('like', $post) }}" method="POST" style="display: inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">💔</button>
                </form>
                @endif
            </div>

            <!-- ブックマーク数といいね数 -->
            <p class="mt-3">
                <span class="badge bg-warning">{{ $post->bookmarks_count }}ブックマーク</span>
                <span class="badge bg-success">{{ $post->likes_count }} いいね！</span>
            </p>

            <p>この投稿の削除予定日: {{ $post->deletion_date->format('Y年m月d日 H:i') }}</p>
            @if ($post->user_id === Auth::id())
            <form action="{{ route('posts.extend', $post->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">表示期間を1日延長</button>
            </form>
            @endif
        </div>
    </div>
    @endforeach

@else
<div class="container mt-5 bg-dark text-white p-5 shadow rounded">
    @foreach ($posts as $post)
    <div class="card bg-secondary text-white mb-5 shadow">
        <div class="card-body">
            <!-- 投稿者の画像 -->
            @if($post->user->img)
            <div class="text-center mb-3">
                <img src="{{ Storage::url('imgs/' .$post->user->img) }}" alt="" class="size shadow">
            </div>
            @endif

            <!-- 投稿者の名前 -->
            <p class="text-center h4">{{ $post->user->name }}</p>

            <!-- 投稿内容 -->
            <div class="bg-dark p-4 rounded shadow-sm mb-2">
                <h3 class="text-light">{{ $post->content }}</h3>
                <div>
                    <p><a href="{{ route('reports.create',['post' => $post->id]) }}">通報する</a></p>
                </div>
            </div>

            <!-- カテゴリーと場所 -->
            <h5><strong>カテゴリ:</strong> {{ $post->category }}</h5>
            <h5><strong>場所:</strong> {{ $post->place }}</h5>

            <!-- アラートメッセージ（投稿に関連付け） -->
            @if(session('alert') && session('alert')['post_id'] == $post->id)
                <div class="alert alert-danger custom-alert">
                    <strong>注意:</strong> {{ session('alert')['message'] }}
                </div>
            @endif

            <!-- ブックマークボタン -->
        {{-- <div class="d-inline">
            <button type="submit" class="btn btn-outline-warning">☆</button>
            <div>FreeユーザーはBM使用不可</div>
        </div> --}}

        <div class="d-inline">
            <!-- ボタンにモーダルのトリガーを設定 -->
            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#freeUserModal">
                ☆
            </button>
            <div>FreeユーザーはBM使用不可</div>
        </div>
        
        <!-- モーダル -->
        <div class="modal fade" id="freeUserModal" tabindex="-1" aria-labelledby="freeUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: black" id="freeUserModalLabel">使用制限のお知らせ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
        

            <!-- いいねボタン -->
            <div class="d-inline ms-3">
                @if(App\Models\Like::where('user_id', Auth::id())->where('post_id', $post->id)->exists())
                <form action="{{ route('unlike', $post) }}" method="POST" style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">💖</button>
                </form>
                @else
                <form action="{{ route('like', $post) }}" method="POST" style="display: inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">💔</button>
                </form>
                @endif
            </div>

            <!-- ブックマーク数といいね数 -->
            <p class="mt-3">
                <span class="badge bg-warning">{{ $post->bookmarks_count }}ブックマーク</span>
                <span class="badge bg-success">{{ $post->likes_count }} いいね！</span>
            </p>

            <p>この投稿の削除予定日: {{ $post->deletion_date->format('Y年m月d日 H:i') }}</p>
            @if ($post->user_id === Auth::id())
            <form action="{{ route('posts.extend', $post->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">表示期間を1日延長</button>
            </form>
            @endif
        </div>
    </div>

    @endforeach
    <div>Freeのユーザーは5つまでしか閲覧できません。サブスク登録をして全ての投稿を見てみましょう。</div>

@endif
</div>

@endsection
