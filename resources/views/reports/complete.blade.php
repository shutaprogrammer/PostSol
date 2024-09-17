<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- リダイレクト --}}
    <meta http-equiv="refresh" content="3;url={{ route('posts.index') }}">
</head>
<body>
    <p>報告が完了しました</p>
    <p>ご協力ありがとうございました</p>
    <p>リダイレクトしない場合は<a href="{{ route('posts.index') }}">こちら</a></p>
</body>
</html>