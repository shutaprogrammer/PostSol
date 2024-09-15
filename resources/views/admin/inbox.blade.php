<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>お問い合わせ受信BOX</h1>
    <div>
        <table border="1">
            <tr>
                <th>ステータス</th>
                <th>id</th>
                <th>タイトル</th>
                <th>内容</th>
            </tr>
            <tr>
                <td>未読/既読</td>
                <td>1</td>
                <td>あの件</td>
                <td>内容一部 <a href="#">詳細表示</a></td>
            </tr>
        </table>
    </div>

    <div>
        <button type="button"><a href="{{ route('admin.menu') }}">メニューへ</a></button>
    </div>
</body>
</html>