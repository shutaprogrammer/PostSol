<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Amazonギフト換金履歴</h1>
    {{-- <div>
        <form action="">
            <input type="text" name="user_id" value="誰が">
            <input type="text" name="number" value="何枚">
            <input type="text" name="money" value="何円分">
        </form>
    </div> --}}
    <div>
        <table border="1">
            <tr>
                <th>ユーザー</th>
                <th>購入枚数</th>
                <th>使用Coin</th>
                <th>購入日時</th>
            </tr>

            @foreach ($gifts as $gift)
            <tr>
                <td>{{ $gift->user_id }}</td>
                <td>{{ $gift->number }}</td>
                <td>{{ $gift->money }}</td>
                <td>{{ $gift->created_at }}</td>
            </tr>
            @endforeach

        </table>
    </div>

    <div>
        <button type="button"><a href="{{ route('admin.menu') }}">メニューへ</a></button>
    </div>
</body>
</html>