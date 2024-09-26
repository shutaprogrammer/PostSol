@extends('layouts.app_original')
@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
    label{
        font-size: 20px !important;
    }


</style>

</style>

<body>
    <div><h1>お問い合わせフォーム</h1></div>

    <div class="d-flex justify-content-center align-items-center mt-5">
        <form action="{{ route('contact.confirm') }}" method="POST" class="row g-3" id="contactForm" style="width: 90%">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="username" class="col-sm-2 col-form-label">作成者様</label><small>（ログイン中のアカウント）</small>
                    <input type="text" readonly class="form-control-plaintext border-primary-subtle w-100 p-3" value="{{ Auth::user()->name }}">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">メールアドレス</label><small>（必須）</small>
                    <input type="email" id="email" class="@error('email') is-invalid @enderror border-primary-subtle w-100 p-3" name="email" value="{{ Auth::user()->email }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small>お問い合わせへの回答送付先をご指定ください。　ご希望のアドレスに変更可能です。</small>
                </div>
            </div>
            <hr>
            <div>
                <label for="category" class="form-label">カテゴリー</label><small>（必須）</small>
                <select name="category" id="category" class="@error('category') is-invalid bg-danger-subtle @enderror form-select bg-danger-subtle border border-primary-subtle w-100 p-3" aria-label="category" required>
                    <option selected disabled>問い合わせのカテゴリーを選ぶ</option>
                    <option value="会員登録" {{ old('category') == '会員登録' ? 'selected' : '' }}>登録情報について</option>
                    <option value="サブスク" {{ old('category') == 'サブスク' ? 'selected' : '' }}>サブスクについて</option>
                    <option value="コイン・換金" {{ old('category') == 'コイン・換金' ? 'selected' : '' }}>コイン・換金について</option>
                    <option value="ランキング" {{ old('category') == 'ランキング' ? 'selected' : '' }}>ランキングについて</option>
                    <option value="その他" {{ old('category') == 'その他' ? 'selected' : '' }}>その他</option>
                </select>
                @error('category')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-12">
                <label for="title" class="form-label">件名</label><small>（任意）</small>
                <input type="text" name="title" class="form-control border-primary-subtle w-100 p-3" id="title">
                <div class="text-end"><small id="charTitleCount" class="text-muted">0 / 80文字</small></div>
            </div>
            <div class="mb-3">
                <label for="detail" class="form-label">本文</label><small>（必須）</small>
                <textarea name="detail" id="detail" class="@error('detail') is-invalid @enderror form-control border-primary-subtle w-100 p-3" rows="10" required>{{ old('detail') }}</textarea>
                <div class="text-end"><small id="charDetailCount" class="text-muted">0 / 5000文字</small></div>
                @error('detail')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        
            <div class="d-flex flex-column align-items-center">
                <button type="submit" class="btn btn-primary btn-lg mb-2">確認画面へ</button>
                <a href="{{ route('posts.index') }}" class="btn btn-outline-dark">キャンセル</a>
            </div>
        </form>

    </div>


    <script>
        //email空白のとき赤
        function empty(){
            const email = document.getElementById('email');

            if(email.value.trim() === ''){
                email.classList.add('bg-danger-subtle');
            } else{
                email.classList.remove('bg-danger-subtle');
            }
        }

        document.getElementById('email').addEventListener('input', empty);

        //カテゴリー未選択の時赤
        const category = document.getElementById('category');

        function notSelect(){
            if(category.value === '問い合わせのカテゴリーを選ぶ'){
                category.classList.add('bg-danger-subtle');
            } else{
                category.classList.remove('bg-danger-subtle');
            }
        }
        notSelect();

        category.addEventListener('change', notSelect);
        
        //文字カウントとオーバーのとき赤
        const maxCharsTitle = 80;
        const maxCharsDetail = 5000;

        function updateCharsCount() {
            const title = document.getElementById('title');
            const charTitleCount = document.getElementById('charTitleCount');
            const currentTitleLength = title.value.length;

            const detail = document.getElementById('detail');
            const charDetailCount = document.getElementById('charDetailCount');
            const currentDetailLength = detail.value.length;

            charTitleCount.textContent = `${currentTitleLength} / ${maxCharsTitle}文字`;
            charDetailCount.textContent = `${currentDetailLength} / ${maxCharsDetail}文字`;
        
            if(currentTitleLength > maxCharsTitle){
                title.classList.add('bg-danger-subtle')
            } else{
                title.classList.remove('bg-danger-subtle')
            }

            if(currentDetailLength > maxCharsDetail){
                detail.classList.add('bg-danger-subtle')
            } else{
                detail.classList.remove('bg-danger-subtle')
            }
        }

        document.getElementById('title').addEventListener('input', updateCharsCount);
        document.getElementById('detail').addEventListener('input', updateCharsCount);

    </script>
    

@endsection