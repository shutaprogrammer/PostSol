<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <ul>
            <li><a href="{{ route('admin.malicious') }}">悪質ユーザー一覧</a></li>
            <li><a href="{{ route('admin.exchange') }}">アマギフ換金機歴</a></li>
            <li><a href="{{ route('admin.inbox') }}">お問い合わせ受信BOX</a></li>
        </ul>
    </div>
</body>
</html>