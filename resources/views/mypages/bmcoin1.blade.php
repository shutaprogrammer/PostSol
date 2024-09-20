@extends('layouts.app_original')
<head><link rel="stylesheet" href="{{ asset('css/bmcoin1.css') }}"></head>
@section('content')

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
        }

        div {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        p {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .product-link {
            display: block;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 1rem;
            text-decoration: none;
            color: #343a40;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
        }

        .product-link:hover {
            background-color: #e9ecef;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
        }

        .product-link span {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .product-link span:last-child {
            font-weight: 600;
            color: #007bff;
        }
    </style>

    <div>
        <p>現在あなたが保有しているBMコイン数：{{ $totalCoins }}</p>
        <p>以下の選択肢から購入したい商品を選択してください。</p>
    </div>

    <div>
        <a href="{{ route('bmcoin.index2', ['coin_count' => 10, 'price' => 100]) }}" class="product-link">
            <span>100BM coin</span>
            <span>10回分</span>
            <span>購入 ￥100円</span>
        </a>
    </div>
    <div>
        <a href="{{ route('bmcoin.index2', ['coin_count' => 20, 'price' => 200]) }}" class="product-link">
            <span>200BM coin</span>
            <span>20回分</span>
            <span>購入 ￥200円</span>
        </a>
    </div>
    <div>
        <a href="{{ route('bmcoin.index2', ['coin_count' => 30, 'price' => 300]) }}" class="product-link">
            <span>300BM coin</span>
            <span>30回分</span>
            <span>購入 ￥300円</span>
        </a>
    </div>
    <div>
        <a href="{{ route('bmcoin.index2', ['coin_count' => 40, 'price' => 400]) }}" class="product-link">
            <span>400BM coin</span>
            <span>40回分</span>
            <span>購入 ￥400円</span>
        </a>
    </div>
@endsection
