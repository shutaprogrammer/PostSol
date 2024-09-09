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
}
