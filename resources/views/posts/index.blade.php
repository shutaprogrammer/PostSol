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
        <p>{{ $post->likes_count }} いいね！</p>
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
</style>

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
            </div>

            <!-- カテゴリーと場所 -->
            <h5><strong>カテゴリ:</strong> {{ $post->category }}</h5>
            <h5><strong>場所:</strong> {{ $post->place }}</h5>

            <!-- ブックマークボタン -->
            <div class="d-inline">
                @if(session('alert') && session('alert')['post_id'] == $post->id)
                    <div class="alert alert-danger">
                        {{ session('alert')['message'] }}
                    </div>
                @endif

            <div class="d-inline">
                @if(App\Models\Bookmark::where('user_id', Auth::id())->where('post_id', $post->id)->exists())
                <form action="{{ route('unbookmark', $post) }}" method="POST" style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-warning">★</button>
                </form>
                @else
                <form action="{{ route('bookmark', $post) }}" method="POST" style="display: inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-warning">☆</button>
                </form>
                @endif
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
        </div>
    </div>
    @endforeach
</div>

@endsection