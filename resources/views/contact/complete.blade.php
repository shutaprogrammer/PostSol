@extends('layouts.app_original')
@section('content')

<header>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</header>
<body>
    <div>
        <h1>送信が完了しました</h1>
    </div>

    <div>
        <p>ご指定のメールアドレスに返信いたします。</p>
    </div>
    <div>
        <p>お返事を差し上げるまでお時間がかかる場合ございます。ご了承いただけますと幸いです。</p>
        <p>目安：３〜５営業日</p>
    </div>
    <hr>
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
        <li style="list-style:none; display:flex; flex-direction:row; justify-content:center; align-content:space-between; ">
            <ul>
                <a href="{{ route('contact.form') }}" class="d-inline-flex focus-ring py-1 px-2 text-decoration-none border rounded-2">
                    お問合せへ戻る
                </a>
            </ul>
            <ul>
                <a href="{{ route('mypages.show') }}" class="d-inline-flex focus-ring py-1 px-2 text-decoration-none border rounded-2">
                    マイページへ戻る
                </a>
            </ul>
            <ul>
                <a href="{{ route('posts.index') }}" class="d-inline-flex focus-ring py-1 px-2 text-decoration-none border rounded-2">
                    投稿一覧へ戻る
                </a>
            </ul>
        </li>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    
</body>
@endsection