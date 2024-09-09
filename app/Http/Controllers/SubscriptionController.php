<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
        // 現在ログインしているユーザーのIDを取得
        $userId = Auth::id();

        // // user_idが現在ログインしているユーザーのIDのstatusレコードを取得
        $status = Status::where('user_id', $userId)->first();

        // subscription1ページのビューとステータスを返す処理
        return view('mypages.subscription1', ['status' => $status]);
    }

    public function index2()
    {
        return view('mypages.subscription2');
    }

    public function index3()
    {
        return view('mypages.subscription3');
    }

    public function complete(Request $request)
    {
        $userId = Auth::id();
        
        // 現在のユーザーのステータスを取得
        $status = Status::where('user_id', $userId)->first();

        if ($status) {
            // ステータスの更新
            $status->status = 'Paid Member'; // 必要なステータスに更新
            $status->save();
            
            // 更新が成功した後、mypageビューにリダイレクト
            return redirect()->route('mypage');
        }

        // ステータスが見つからない場合のエラーハンドリング
        return redirect()->back()->withErrors(['msg' => 'ステータスの更新に失敗しました。']);
    }
}
