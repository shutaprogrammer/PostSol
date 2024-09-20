<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>送信内容確認</h1>


    <form action="{{ route('contact.send') }}" method="POST" class="row g-3">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <label for="staticEmail" class="col-sm-2 col-form-label">作成者様</label>
                <input type="text" readonly class="form-control-plaintext w-75 p-3" value="{{ Auth::user()->name }}">
            </div>
            <div class="col-md-5">
                <label for="inputPassword4" class="form-label">メールアドレス</label><br>
                <input type="email" readonly class="w-75 p-3" name="email" value="{{ $email }}">
            </div>
        </div>

        <div>
            <label for="inputAddress" class="form-label">件名</label>
            <input type="text" readonly name="category" class="form-control w-75 p-3" id="" value="{{ $category }}">
        </div>

        <div class="col-12">
            <label for="inputAddress" class="form-label">件名</label>
            <input type="text" readonly name="title" class="form-control w-75 p-3" id="" value="{{ $title }}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">本文</label>
            <textarea name="detail" readonly class="form-control w-75 p-3" id="exampleFormControlTextarea1" rows="10">{{ $detail }}</textarea>
        </div>
    
        <div>
            <button type="submit" class="btn btn-primary btn-lg">送信</button>
        </div>
    </form>

    <a href="{{ route('contact.form') }}"><button type="button" class="btn btn-outline-info">修正</button></a>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>