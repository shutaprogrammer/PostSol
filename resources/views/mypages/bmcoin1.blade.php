@extends('layouts.app_original')
<head><link rel="stylesheet" href="{{ asset('css/bmcoin1.css') }}"></head>
@section('content')

    {{-- <h3>現在あなたが保有しているBMコイン数：{{ $totalCoins }}</h3>
    <h3>以下の選択肢から購入したい商品を選択してください。</h3> --}}

<div class="coin-list">
<div class="container">
    <img src="{{ asset ('storage/imgs/coin_medal_gold.png') }} " alt="" class="gold">
    <div class="group">
        <div class="content">BMコイン：100枚 10回分</div>
        <div class="price">￥100円</div>
    <a href="{{ route('bmcoin.index2', ['coin_count' => 10, 'price' => 100]) }}" class="btn">購入</a>
    </div>
</div>

<div class="container">
    <img src="{{ asset ('storage/imgs/coin_medal_gold.png') }} " alt="" class="gold">
<div class="group">
    <div class="content">BMコイン：200枚 20回分</div>
    <div class="price">￥200円</div>
    <a href="{{ route('bmcoin.index2', ['coin_count' => 20, 'price' => 200]) }}" class="btn">購入</a>
</div>
</div>

<div class="container">
    <img src="{{ asset ('storage/imgs/coin_medal_gold.png') }} " alt="" class="gold">
<div class="group">
    <div class="content">BMコイン：300枚 30回分</div>
    <div class="price">￥300円</div>
    <a href="{{ route('bmcoin.index2', ['coin_count' => 30, 'price' => 300]) }}" class="btn">購入</a>
</div>
</div>

<div class="container">
    <img src="{{ asset ('storage/imgs/coin_medal_gold.png') }} " alt="" class="gold">
<div class="group">
    <div class="content">BMコイン：400枚 40回分</div>
    <div class="price">￥400円</div>
    <a href="{{ route('bmcoin.index2', ['coin_count' => 40, 'price' => 400]) }}" class="btn">購入</a>
</div>
</div>
</div>
@endsection