@extends('layouts.app_original')
@section('content')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>

    #label{
        font-size: 25px !important;
    }
    .form-check-input{
        transform: scale(1.2);
        
    }
    .form-check-label{
        font-size: 1.2rem;
        padding-left: 1em;
    }
</style>


<body>
    <div>
        <h1>通報する</h1>
    </div>

    <div  class="d-flex justify-content-center align-items-center mt-5">
        <form action="{{ route('reports.confirm', ['post' => $post->id]) }}" method="POST" style="width: 80%">
            @csrf
            <div class="fs-5">
                <p>投稿ユーザー：{{ $post->user->name}}</p>
                <p>内容：{{ $post->content }}</p>
            </div>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="user_id" value="{{ $post->user_id }}">

            <hr>

            <div class="mt-4">
                <label for="reason" class="form-label" id="label">報告理由</label>
                <div class="form-check">
                    <label for="reason_1" class="form-check-label">
                        <input class="form-check-input" type="radio" id="reason_1" name="reason" value="荒らし行為"> 荒らし行為
                    </label>
                </div>
                <div class="form-check">
                    <label for="reason_2" class="form-check-label">
                        <input class="form-check-input" type="radio" id="reason_2" name="reason" value="差別的発言"> 差別的発言
                    </label>
                </div>
                <div class="form-check">
                    <label for="reason_3" class="form-check-label">
                        <input class="form-check-input" type="radio" id="reason_3" name="reason" value="誹謗中傷"> 誹謗中傷
                    </label>
                </div>
    
                <div class="form-check">
                    <label for="reason_4" class="form-check-label" >
                        <input class="form-check-input" type="radio" id="reason_4" name="reason" value="プライバシー侵害"> プライバシー侵害
                    </label>
                </div>
    
                <div class="form-check">
                    <label for="reason_5" class="form-check-label">
                        <input class="form-check-input" type="radio" id="reason_5" name="reason" value="スパム"> スパム
                    </label>
                </div>
    
                <div class="form-check">
                    <label for="reason_other" class="form-check-label">
                        <input class="form-check-input" type="radio" id="reason_other" name="reason" value="その他"> その他
                    </label>
                </div>
            </div>

            <div class="mt-4">
                <label for="detail" class="form-label" id="label">詳細を記入</label>
                <textarea class="form-control" name="detail" id="detail" cols="100" rows="10">{{ old('detail') }}</textarea>
                <div class="text-end"><small id="charCountDetail" class="text-muted">0 / 1000文字</small></div>
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('posts.index') }}"><button type="button" class="btn btn-outline-secondary">キャンセル</button></a>
                <button type="submit" class="btn btn-primary">確　認</button>
            </div>
        </form>
    </div>
    
    <script>
        const maxDetailChars = 1000;

        function updateCharsCount(){
            const detail = document.getElementById('detail');
            const charCountDetail = document.getElementById('charCountDetail');
            const currentDetailCount = detail.value.length;

            charCountDetail.textContent = `${currentDetailCount} / ${maxDetailChars}文字`;

            if(currentDetailCount > maxDetailChars){
                detail.classList.add('bg-danger-subtle');
            } else{
                detail.classList.remove('bg-danger-subtle');
            }
        }

        document.getElementById('detail').addEventListener('input', updateCharsCount);



    </script>

    

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
@endsection