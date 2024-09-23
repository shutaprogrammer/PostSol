@extends('layouts.app_original')
@section('content')

<head>
    {{-- リダイレクト --}}
    <meta http-equiv="refresh" content="3;url={{ route('posts.index') }}">
</head>
<body>
    <div style="text-align: center">
        <p class="fs-3">報告が完了しました</p>
        <p class="fs-4">ご協力ありがとうございました。</p>
        <hr>
        <p class="fs-5">3秒後、自動で元のページに戻ります。</p>
        <p class="fs-5">移動しない場合は<a href="{{ route('posts.index') }}">こちら</a></p>
    </div>

</body>
@endsection