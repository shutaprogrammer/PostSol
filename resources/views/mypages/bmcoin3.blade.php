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
    <p>あなたが選択した商品</p>
    <p>{{ $coinCount }}回分 ￥{{ $price }}円</p>
    <p>まだBMコインは追加されていません！以下のボタンから追加を完了して下さい。</p>
    @if($price == 100)
    <form action="{{ route('Coin.Complete100') }}" method="POST">
        @csrf
        <button type="submit">BMコイン追加100</button>
    </form>
    @elseif($price == 200)
    <form action="{{ route('Coin.Complete200') }}" method="POST">
        @csrf
        <button type="submit">BMコイン追加200</button>
    </form>
    @elseif($price == 300)
    <form action="{{ route('Coin.Complete300') }}" method="POST">
        @csrf
        <button type="submit">BMコイン追加300</button>
    </form>
    @elseif($price == 400)
    <form action="{{ route('Coin.Complete400') }}" method="POST">
        @csrf
        <button type="submit">BMコイン追加400</button>
    </form>
    @endif
</body>
</html>