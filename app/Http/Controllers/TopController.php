<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TopController extends Controller
{
    public function index()
    {
        // アンケートページのビューを返す処理
        return view('tops.question');
    }

    function store(Request $request)
    {
        // アンケートの内容をデータベースに保存
        $user = new User;
        //左辺:テーブル、右辺が送られてきた値(formから送られてきたnameが入っている)
        $user -> job = $request -> job;
        $user -> marital = $request -> marital;
        $user -> children = $request -> children;
        $user -> salary = $request -> salary;
        $user -> business = $request -> business;

        $user -> save();

        return redirect()->route('home');
    }
}
