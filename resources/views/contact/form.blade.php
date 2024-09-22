@extends('layouts.app_original')
@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
    label{
        font-size: 20px !important;
    }

    input .is-invalid {
        border-color: red !important;
    }
</style>

<body>
    <div><h1>お問い合わせフォーム</h1></div>

    <div class="d-flex justify-content-center align-items-center mt-5">
        <form action="{{ route('contact.confirm') }}" method="POST" class="row g-3" id="contactForm" style="width: 90%">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="username" class="col-sm-2 col-form-label">作成者様</label><small>（現在ログイン中のアカウント）</small>
                    <input type="text" readonly class="form-control-plaintext border-primary-subtle w-100 p-3" value="{{ Auth::user()->name }}">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">メールアドレス</label><small>（必須）</small>
                    <input type="email" id="email" class="border-primary-subtle w-100 p-3" name="email" value="{{ Auth::user()->email }}">
                    <small>お問い合わせへの回答送付先をご指定ください。　ご希望のアドレスに変更可能です。</small>
                </div>
            </div>
            <hr>
            <div>
                <label for="category" class="form-label">カテゴリー</label><small>（必須）</small>
                <select name="category" id="category" class="form-select border border-primary-subtle w-100 p-3" aria-label="category">
                    <option selected disabled>問い合わせのカテゴリーを選ぶ</option>
                    <option value="会員登録">登録情報について</option>
                    <option value="サブスク">サブスクについて</option>
                    <option value="コイン・換金">コイン・換金について</option>
                    <option value="ランキング">ランキングについて</option>
                    <option value="その他">その他</option>
                </select>
            </div>

            <div class="col-12">
                <label for="title" class="form-label">件名</label><small>（任意）</small>
                <input type="text" name="title" class="form-control border-primary-subtle w-100 p-3" id="" placeholder="">
            </div>
            <div class="mb-3">
                <label for="detail" class="form-label">本文</label><small>（必須）</small>
                <textarea name="detail" id="detail" class="form-control border-primary-subtle w-100 p-3" id="exampleFormControlTextarea1" rows="10"></textarea>
            </div>
        
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-lg">確認画面へ</button>
            </div>

            <div><a href=""><button type="button" class="btn btn-outline-dark">キャンセル</button></a></div>
        </form>

    </div>


    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event){
            const emailInput = document.getElementById('email');
            const categoryInput = document.getElementById('category');
            const detailInput = document.getElementById('detail');
    
            if(emailInput.value === ''){
                emailInput.classList.add('is-invalid');
                event.preventDefault();
            } else {
                emailInput.classList.remove('is-invalid');
            }
    
            if(categoryInput.value === '' || categoryInput.value === '問い合わせのカテゴリーを選ぶ'){
                categoryInput.classList.add('is-invalid');
                event.preventDefault();
            } else {
                categoryInput.classList.remove('is-invalid');
            }
    
            if(detailInput.value === ''){
                detailInput.classList.add('is-invalid');
                event.preventDefault();
            } else {
                detailInput.classList.remove('is-invalid');
            }
        });
    </script>
    


</body>
@endsection