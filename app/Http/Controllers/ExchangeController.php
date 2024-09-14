<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Coin;
use App\Models\Amazon;


class ExchangeController extends Controller
{
    public function index()
    {
        // ユーザーのBMコイン総数を計算
        $totalCoins = Coin::where('user_id', Auth::id())->sum('amount');

        return view('mypages.exchange', compact('totalCoins'));
    }

    public function process(Request $request)
    {
        // リクエストのバリデーション
        $validated = $request->validate([
            'amount' => 'required|integer|min:500',
        ]);

        $amount = $validated['amount']; // 交換に使用するコイン数
        $userId = Auth::id();

        // ユーザーの現在のコイン数を取得
        $totalCoins = Coin::where('user_id', $userId)->sum('amount');

        if ($totalCoins >= $amount) {
            // 交換するギフト券の枚数を計算
            $numberOfTickets = $amount / 500;

            // トランザクション内で処理を実行
            DB::transaction(function () use ($userId, $amount, $numberOfTickets) {
                // amazonsテーブルに交換レコードを追加
                Amazon::create([
                    'user_id' => $userId,
                    'number' => $numberOfTickets,
                    'money' => $amount, // 交換したコイン数を記録
                ]);

                // coinsテーブルに新しいレコードを追加（コインの使用履歴として保存）
                Coin::create([
                    'user_id' => $userId,
                    'amount' => -$amount, // 減少したコイン数を記録
                    'description' => "Amazonギフト券交換（${numberOfTickets}枚）",
                ]);
            });

            return redirect()->route('mypages.exchange')->with('success', 'ギフト券の交換が完了しました。');
        } else {
            return redirect()->route('mypages.exchange')->with('error', 'コインが不足しています。');
        }
    }
}