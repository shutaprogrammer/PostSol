<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>悪質投稿報告</h1>
    <div>
        <p>投稿ユーザー：{{ $post->user->name}}</p>
        <p>内容：{{ $post->content }}</p>
    </div>
    <form action="{{ route('reports.confirm', ['post' => $post->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <input type="hidden" name="user_id" value="{{ $post->user_id }}">
        <label for="reason_1"><input type="radio" id="reason_1" name="reason" value="荒らし行為"> 荒らし行為</label><br>
        <label for="reason_2"><input type="radio" id="reason_2" name="reason" value="差別的発言"> 差別的発言</label><br>
        <label for="reason_3"><input type="radio" id="reason_3" name="reason" value="誹謗中傷"> 誹謗中傷</label><br>
        <label for="reason_4"><input type="radio" id="reason_4" name="reason" value="プライバシー侵害"> プライバシー侵害</label><br>
        <label for="reason_5"><input type="radio" id="reason_5" name="reason" value="スパム"> スパム</label><br>
        <label for="reason_other"><input type="radio" id="reason_other" name="reason" value="その他"> その他</label><br>
        <textarea name="detail" id="detail" cols="30" rows="10">{{ old('detail') }}</textarea>
        <button type="submit">確認</button>
    </form>
    <a href="{{ route('posts.index') }}"><button type="button">キャンセル</button></a>
    

</body>
</html>