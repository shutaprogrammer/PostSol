<style>
  /* 全体のスタイル */
.post-form {
    max-width: 600px;
    margin: auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-weight: bold;
    margin-bottom: 8px;
    color: #333;
}

.form-value {
    font-size: 16px;
    color: #555;
}

/* ボタンのスタイル */
.form-actions {
    text-align: center;
}

.btn-submit {
    background-color: #007BFF;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}

.btn-submit:hover {
    background-color: #0056b3;
}

.btn-back {
    background-color: #6c757d;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    margin-left: 10px;
    cursor: pointer;
}

.btn-back:hover {
    background-color: #5a6268;
}

</style>

@extends('layouts.app_original')

@section('content')
<form action="{{ route('posts.store') }}" method="POST" class="post-form">
  @csrf
  <div class="form-group">
    <label for="category" class="form-label">カテゴリー</label>
    <div class="form-value">{{ $post_data->category }}</div>
    <input type="hidden" id="category" name="category" value="{{ $post_data->category }}">
  </div>
  <div class="form-group">
      <label for="place" class="form-label">場所</label>
      <div class="form-value">{{ $post_data->place }}</div>
      <input type="hidden" id="place" name="place" value="{{ $post_data->place }}">
  </div>
  <div class="form-group">
      <label for="content" class="form-label">内容</label>
      <div class="form-value">{{ $post_data->content }}</div>
      <input type="hidden" id="content" name="content" value="{{ $post_data->content }}">
  </div>
  <div class="form-actions">
      <button type="submit" class="btn-submit">投稿</button>
      <button type="submit" name="back" value="back" class="btn-back">戻る</button>
  </div>
</form>
@endsection