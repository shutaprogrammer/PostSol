<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .form-check-input{
            transform: scale(1.2);
            
        }

        .form-check-label{
            font-size: 1.2rem;
        }
    </style>

</head>

<body>
    <h1>悪質投稿報告</h1>
    <div  class="w-75 p-3 container d-flex justify-content-center">

        <form action="{{ route('reports.confirm', ['post' => $post->id]) }}" method="POST">
            @csrf
            <div class="fs-5">
                <p>投稿ユーザー：{{ $post->user->name}}</p>
                <p>内容：{{ $post->content }}</p>
            </div>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="user_id" value="{{ $post->user_id }}">

            
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
            
            <div class="m-3">
                <label for="detail" class="form-label">詳細を記入</label>
                <textarea class="form-control" name="detail" id="detail" cols="30" rows="10">{{ old('detail') }}</textarea>
            </div>
            <div><button type="submit" class="btn btn-primary">確認</button></div>
        </form>
    </div>
    
    <a href="{{ route('posts.index') }}"><button type="button" class="btn btn-outline-secondary">キャンセル</button></a>
    

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>