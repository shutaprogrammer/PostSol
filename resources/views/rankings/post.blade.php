@extends('layouts.app_original')
@section('content')
<style>
  .size {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
  }
  .ranking-icon {
      width: 110px;
      height: 100px;
      object-fit: cover;
  }
  .rank-display {
      text-align: left;
      display: flex;
      align-items: center;
  }
  .rank-text {
      margin-left: 10px; /* 画像と文字の間にスペースを追加 */
  }
</style>

<h2>投稿ランキング（直近３０日間）</h2>

@foreach ($posts as $post)
    <div class="card bg-secondary text-white mb-5 shadow">
        <div class="card-body">
            <!-- 順位 -->
            <div class="rank-display">
                @php
                    $rankImage = '';
                    switch ($loop->iteration) {
                        case 1:
                            $rankImage = Storage::url('imgs/1st_place.jpg');
                            break;
                        case 2:
                            $rankImage = Storage::url('imgs/2nd_place.jpg');
                            break;
                        case 3:
                            $rankImage = Storage::url('imgs/3rd_place.jpg');
                            break;
                        default:
                            $rankImage = ''; // 他の順位の場合は何も表示しない
                    }
                @endphp

                @if ($rankImage)
                    <img src="{{ $rankImage }}" alt="Rank {{ $loop->iteration }}" class="ranking-icon">
                @else
                    <h3 class="text-light rank-text">順位: {{ $loop->iteration }}</h3>
                @endif
            </div>

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

            <!-- アラートメッセージ（投稿に関連付け） -->
            @if(session('alert') && session('alert')['post_id'] == $post->id)
                <div class="alert alert-danger custom-alert">
                    <strong>注意:</strong> {{ session('alert')['message'] }}
                </div>
            @endif

            <!-- ブックマークボタン -->
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

@endsection