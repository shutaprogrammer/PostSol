<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>悪質ユーザー報告</h1>
    <div>
        <table border="1">
            <tr>
                <th>報告日</th>
                <th>投稿者</th>
                <th>投稿内容</th>
                <th>報告理由</th>
                <th>詳細</th>
            </tr>
            @foreach ($reports as $report)
            <tr>
                <td>{{ $report->created_at->format('Y-m-d') }}</td>
                <td>{{ $report->user->name }}（{{ $report->user->id }}）</td>
                <td>{{ $report->post->content }}</td>
                <td>{{ $report->reason }}</td>
                <td>{{ $report->detail }}</td>
            </tr>
            @endforeach
        </table>

    </div>

    <div>
        <button type="button"><a href="{{ route('admin.menu') }}">メニューへ</a></button>
    </div>
</body>
</html>