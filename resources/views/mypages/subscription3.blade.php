<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        h1 {
            font-size: 2rem;
            color: #343a40;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 2rem;
        }

        button {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
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
    <p>まだサブスクの登録は終了していません！以下のボタンで登録を完了して下さい。</p>
    <form action="{{ route('subscription.complete') }}" method="POST">
        @csrf
        <button type="submit">サブスクリプション登録を完了する</button>
    </form>
</body>
</html>
