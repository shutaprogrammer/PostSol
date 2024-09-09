<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>決済完了。ご購入有難うございます。</h1>
    <p>まだBMコインは追加されていません！以下のボタンから追加を完了して下さい。</p>
    <form action="{{ route('subscription.complete') }}" method="POST">
        @csrf
        <button type="submit">BMコイン追加</button>
    </form>
</body>
</html>