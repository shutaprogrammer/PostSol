<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=dev ice-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>お問い合わせフォーム</h1>

    <form action="{{ route('contact.confirm') }}" method="POST" class="row g-3">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <label for="staticEmail" class="col-sm-2 col-form-label">作成者様</label>
                <input type="text" readonly class="form-control-plaintext border-primary-subtle w-75 p-3" value="{{ Auth::user()->name }}">
            </div>
            <div class="col-md-5">
                <label for="inputPassword4" class="form-label">メールアドレス</label><br>
                <input type="email" class="border-primary-subtle w-75 p-3" name="email" value="{{ Auth::user()->email }}">
            </div>
        </div>

        <div>
            <select name="category" class="form-select border border-primary-subtle w-75 p-3" aria-label="Default select example">
                <option selected>問い合わせのカテゴリーを選ぶ</option>
                <option value="会員登録">会員登録について</option>
                <option value="サブスク">サブスクについて</option>
                <option value="コイン・換金">コイン・換金について</option>
                <option value="ランキング">ランキングについて</option>
                <option value="その他">その他</option>
            </select>
        </div>

        <div class="col-12">
            <label for="inputAddress" class="form-label">件名</label>
            <input type="text" name="title" class="form-control border-primary-subtle w-75 p-3" id="" placeholder="">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">本文</label>
            <textarea name="detail" class="form-control border-primary-subtle w-75 p-3" id="exampleFormControlTextarea1" rows="10"></textarea>
        </div>
    
        <div>
            <button type="submit" class="btn btn-primary btn-lg">確認画面へ</button>
        </div>
    </form>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>