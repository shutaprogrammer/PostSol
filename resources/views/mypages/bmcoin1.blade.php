@extends('layouts.app_original')
@section('content')
<div>
    <a href="{{ route('bmcoin.index2', ['coin_count' => 10, 'price' => 100]) }}">
    <span>100BM coin</span><span>10回分</span><span>購入 ￥100円</span>
    </a>
</div>
<div>
    <a href="{{ route('bmcoin.index2', ['coin_count' => 20, 'price' => 200]) }}">
    <span>200BM coin</span><span>20回分</span><span>購入 ￥200円</span>
    </a>
</div>
<div>
    <a href="{{ route('bmcoin.index2', ['coin_count' => 30, 'price' => 300]) }}">
    <span>300BM coin</span><span>30回分</span><span>購入 ￥300円</span>
    </a>
</div>
<div>
    <a href="{{ route('bmcoin.index2', ['coin_count' => 40, 'price' => 400]) }}">
    <span>400BM coin</span><span>40回分</span><span>購入 ￥400円</span>
    </a>
</div>
@endsection