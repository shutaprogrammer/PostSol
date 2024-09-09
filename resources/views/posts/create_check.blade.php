@extends('layouts.app_original')
@section('content')
<form action="{{ route('posts.store') }}" method="POST">
  @csrf
  <div>
    <label for="category">カテゴリー</label>
    {{ $post_data->category }}
  <input type="hidden" id="category" name="category" value="{{ $post_data->category }}">
  </div>
  <div>
      <label for="place">場所</label>
      {{ $post_data->place }}
  <input type="hidden" id="place" name="place" value="{{ $post_data->place }}">
  </div>
  <div>
      <label for="content">内容</label>
      {{ $post_data->content }}
      <input type="hidden" id="content" name="content" value="{{ $post_data->content }}">
  </div>
  <button type="submit">投稿</button>
  <button type="submit" name="back" value="back">戻る</button>
</form>
@endsection