@extends('layouts.app_original')
@section('content')
    <h3>サブスクリプション登録</h3>
    <p>1か月 ￥1000円 (＊自動更新はされません) <br>以下のボタンから決済してください。4242424242424242</p>
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
    @endsection