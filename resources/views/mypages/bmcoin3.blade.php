<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>決済完了</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        h1 {
            font-size: 1.75rem;
            color: #343a40;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        form {
            display: inline-block;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 1.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        button {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
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
