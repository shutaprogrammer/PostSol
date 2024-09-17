<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>報告内容確認</h1>
    <p>投稿者：{{ $post->user->name }}</p>
    <p>投稿内容：{{ $post->content }}</p>
    <p>報告内容：{{ $reason }}</p>
    <p>詳細：{{ $detail }}</p>
    <form action="{{ route('reports.store',['post' => $post->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="reason" value="{{ $reason }}">
        <input type="hidden" name="detail" value="{{ $detail }}">
        <button type="submit">報告する</button>
    </form>
    
    <a href="{{ route('reports.create', [$post->id]) }}"><button type="button">修正</button></a>

</body>
</html>