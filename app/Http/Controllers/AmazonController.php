<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AmazonController extends Controller
{
    public function exchange(Request $request)
    {
        // バリデーション: 500コイン以上を入力する必要がある
        $validated = $request->validate([
            'number' => 'required|integer|min:1',
        ]);

        $userId = Auth::id();
        $number = $validated['number']; // ギフト券の枚数
        $money = $number * 500; // 1枚につき500コイン

        // 現在のコイン総数を取得
        $totalCoins = Coin::where('user_id', $userId)->sum('amount');

        if ($totalCoins >= $money) {
            // コインを減らす
            Coin::create([
                'user_id' => $userId,
                'amount' => -$money,
            ]);

            // Amazonギフト券交換履歴をamazonsテーブルに記録
            Amazon::create([
                'user_id' => $userId,
                'number' => $number,
                'money' => $money,
            ]);

            return redirect()->route('mypages.exchange')->with('success', 'ギフト券の交換が完了しました。');
        } else {
            return redirect()->route('mypages.exchange')->with('error', 'コインが不足しています。');
        }
    }

}
