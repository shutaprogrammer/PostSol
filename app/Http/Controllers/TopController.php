<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    // public function index($user_id)
    // {
    //     $users = User::all();
    //     // アンケートページのビューを返す処理
    //     return view('tops.question', ['users' => $users]);
    // }

    // function update(Request $request, $id)
    // {
    //     // アンケートの内容をデータベースに保存
    //     $user = User::find($id); // データベースから特定のユーザーを取得
    // if (!$user) {
    //     // ユーザーが見つからない場合の処理
    //     return redirect()->back()->withErrors('User not found');
    // }
    //     //左辺:テーブル、右辺が送られてきた値(formから送られてきたnameが入っている)
    //     $user -> job = $request -> job;
    //     $user -> marital = $request -> marital;
    //     $user -> children = $request -> children;
    //     $user -> salary = $request -> salary;
    //     $user -> business = $request -> business;

    //     $user -> save();

    //     return redirect()->route('home');
    // }
}
