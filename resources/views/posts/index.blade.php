@extends('layouts.app_original')
@section('content')

<div>
    @foreach ($posts as $post)
    @if($post->user->img)
    <img src="{{ Storage::url('imgs/' .$post->user->img) }}" alt="">
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


@endsection