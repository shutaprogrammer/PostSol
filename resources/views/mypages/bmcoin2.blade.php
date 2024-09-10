@extends('layouts.app_original')
@section('content')
    <h3>BMコイン購入</h3>
    <p>{{ $coinCount }}回分 ￥{{ $price }}円 <br>以下のボタンから決済してください。4242424242424242</p>
    <form action="{{ route('bmcoin.index3') }}" method="GET">
        @csrf
        <input  value="{{ $coinCount }}, {{ $price }}" > 
        <p>以下のボタンから決済してください。4242424242424242</p>
        <button type="submit">確認</button>
    </form>

<form action="{{ route('payment.CoinCharge') }}" method="post">
    @csrf
    <script
            src="https://checkout.pay.jp/"
            class="payjp-button"
            data-key="{{ config('payjp.public_key') }}"
            data-text="カード情報を入力・決済"
            data-submit-text="決済する"
    ></script>
</form>

@endsection