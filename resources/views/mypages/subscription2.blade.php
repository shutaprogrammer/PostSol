@extends('layouts.app_original')
@section('content')
    <style>
        /* サブスクリプションセクションのスタイリング */
        h3 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1rem;
            line-height: 1.5;
            margin-bottom: 1.5rem;
        }

        ul {
            margin-bottom: 1.5rem;
        }

        ul li {
            font-size: 1rem;
            line-height: 1.5;
        }

        button {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 0.5rem 1.25rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-container {
            background-color: #f8f9fa;
            padding: 2rem;
            border-radius: 0.375rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .form-container p {
            font-size: 1rem;
            line-height: 1.5;
        }

        section{
            margin-bottom: 42vh;
        }
    </style>

    <section class="form-container">
        <h3>サブスクリプション登録</h3>
        <p>1か月 ￥1000円 (＊自動更新はされません) <br>以下のボタンから決済してください。</p>
        <form action="{{ route('payment.createCharge') }}" method="post">
            @csrf
            <script
                src="https://checkout.pay.jp/"
                class="payjp-button"
                data-key="{{ config('payjp.public_key') }}"
                data-text="カード情報を入力・決済"
                data-submit-text="決済する"
            ></script>
        </form>
    </section>
@endsection
