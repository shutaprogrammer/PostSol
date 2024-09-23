@extends('layouts.app_original')
@section('content')
    <style>
        /* body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        } */

        h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #343a40;
        }

        form {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 1.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            width: 100%;
            max-width: 400px;
            text-align: center;
            margin-bottom: 80%;
        }

        span {
            display: block;
            margin-bottom: 1rem;
            font-size: 1.25rem;
            font-weight: 600;
            color: #007bff;
        }

        p {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .payjp-button {
            border: none;
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
            color: #fff;
            background-color: #007bff;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .payjp-button:hover {
            background-color: #0056b3;
        }
    </style>

    <h3>BMコイン購入</h3>
    <form action="{{ route('payment.CoinCharge') }}" method="post">
        @csrf
        <span>{{ $coinCount }}回分, ￥{{ $price }}</span>
        <input type="hidden" name="coin_count" value="{{ $coinCount }}">
        <input type="hidden" name="price" value="{{ $price }}">
        <p>以下のボタンから決済してください。</p>
        <script
            src="https://checkout.pay.jp/"
            class="payjp-button"
            data-key="{{ config('payjp.public_key') }}"
            data-text="カード情報を入力・決済"
            data-submit-text="決済する"
        ></script>
    </form>
@endsection
