@extends('layouts.app_original')
@section('content')
    <h3>BMコイン購入</h3>
<form action="{{ route('payment.CoinCharge') }}" method="post">
    @csrf
    <span>{{ $coinCount }}回分, ￥{{ $price }} </span>
    <input type="hidden" name="coin_count" value="{{ $coinCount }}">
    <input type="hidden" name="price" value="{{ $price }}">
    <p>以下のボタンから決済してください。4242424242424242</p>
    <script
            src="https://checkout.pay.jp/"
            class="payjp-button"
            data-key="{{ config('payjp.public_key') }}"
            data-text="カード情報を入力・決済"
            data-submit-text="決済する"
    ></script>
</form>

@endsection