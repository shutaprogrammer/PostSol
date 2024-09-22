@extends('layouts.app_original')
@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        label{
            font-size: 20px !important;
        }
    </style>
</head>
<body>
    <h1>送信内容確認</h1>

    <div  class="d-flex justify-content-center align-items-center mt-5">
        <form action="{{ route('contact.send') }}" method="POST" class="row g-3" style="width: 90%">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="username" class="col-sm-2 col-form-label">作成者様</label>
                    <input type="text" readonly class="form-control-plaintext w-100 p-3 border" value="{{ Auth::user()->name }}">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">メールアドレス</label>
                    <input type="email" readonly class="form-control-plaintext w-100 p-3 border" name="email" value="{{ $email }}">
                </div>
            </div>
    
            <div>
                <label for="category" class="form-label">カテゴリー</label>
                <input type="text" readonly name="category" class="form-control-plaintext w-100 p-3 border" id="" value="{{ $category }}">
            </div>
    
            <div class="col-12">
                <label for="title" class="form-label">件名</label>
                <input type="text" readonly name="title" class="form-control-plaintext w-100 p-3 border" id="" value="{{ $title }}">
            </div>
            <div class="mb-3">
                <label for="detail" class="form-label">本文</label>
                <textarea name="detail" readonly class="form-control-plaintext w-100 p-3 border" id="" rows="10">{{ $detail }}</textarea>
            </div>
        
            <div class="d-flex justify-content-between">
                <div>
                    <a href="{{ route('contact.form') }}"><button type="button" class="btn btn-outline-info">修正</button></a>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-lg">送信</button>
                </div>
            </div>
        </form>
    
        
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
@endsection