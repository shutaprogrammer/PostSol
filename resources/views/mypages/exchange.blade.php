@extends('layouts.app_original')
@section('content')

<div>
    保有BMコイン数: <span class="badge bg-warning" id="totalCoins">{{ $totalCoins }}　</span>
</div>

<div>
    @if($totalCoins < 500)
        <p>コインが不足しています。交換するには500BMコイン以上必要です。</p>
    @else
        <form id="exchangeForm" action="{{ route('exchange.process') }}" method="POST">
            @csrf
            <p>交換可能なAmazonギフト券の枚数を選択してください:</p>
            @foreach(range(1, 10) as $number)
                @php
                    $requiredCoins = 500 * $number;
                @endphp
                @if($totalCoins >= $requiredCoins)
                    <button type="button" class="btn btn-primary" onclick="showRemainingCoins({{ $requiredCoins }}, {{ $number }})">
                        {{ $number }} 枚
                    </button>
                @else
                    <button type="button" class="btn btn-secondary" disabled>
                        {{ $number }} 枚
                    </button>
                @endif
            @endforeach
        </form>
    @endif
</div>

<div>
    <p id="remainingCoins">選択した枚数に応じて交換後のコイン数が表示されます。</p>
    <button id="confirmExchangeBtn" class="btn btn-success" style="display:none;" onclick="submitExchange()">交換実行</button>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<script>
    let selectedAmount = 0;

    function showRemainingCoins(requiredCoins, numberOfTickets) {
        // 現在のコイン数を取得
        const totalCoins = parseInt(document.getElementById('totalCoins').textContent.trim());

        // 交換後のコイン数を計算
        const remainingCoins = totalCoins - requiredCoins;

        // 交換後のコイン数を表示
        document.getElementById('remainingCoins').textContent = `交換後の総BMコイン数: ${remainingCoins}`;

        // 選択した枚数を保持
        selectedAmount = requiredCoins;

        // 交換実行ボタンを表示
        document.getElementById('confirmExchangeBtn').style.display = 'block';
    }

   function submitExchange() {
        // 隠れたフィールドに選択されたコイン数をセット
        const form = document.getElementById('exchangeForm');
        const hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = 'amount';
        hiddenField.value = selectedAmount;
        form.appendChild(hiddenField);

        // フォームを送信
        form.submit();
    }
</script>

@endsection