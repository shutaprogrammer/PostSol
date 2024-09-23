@extends('layouts.app_original')
@section('content')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div>
        <h1>報告内容確認</h1>
    </div>

    <div class="mt-5 d-flex flex-column justify-content-center align-items-center h-100">
        <form action="{{ route('reports.store',['post' => $post->id]) }}" method="POST" style="width: 80%">
            @csrf
            <div>
                <div id="contents">
                    <p class="fs-5">投稿者：{{ $post->user->name }}</p>
                    <p class="fs-5">投稿内容：{{ $post->content }}</p>
                    <p class="fs-5">報告内容：{{ $reason }}</p>
                    <p class="fs-5">詳細：{{ $detail }}</p>
                </div>
        
        
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="reason" value="{{ $reason }}">
                <input type="hidden" name="detail" value="{{ $detail }}">
        
                <div class="mt-5">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">報告する</button>
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        <a href="{{ route('reports.create', [$post->id]) }}"><button type="button" class="btn btn-outline-secondary">←修正</button></a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    
</body>
@endsection