<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create ()
    {
        return view('tops.create_profile');
    }

    public function store (Request $request) 
    {
        $user = new User();
        
        $user->img = $request->img;
        $user->gender = $request->gender;
        $user->birth = $request->birth;
        $user->country = $request->country;
        $user->prefecture = $request->prefecture;
        $user->city = $request->city;

        if(request('img')) {
            $original = request()->file('img')->getClientOriginalName();
            $name = date('Ymd_His'). '_' . $original;
            request()->file('img')->move('storage/imgs', $name);
            $user->img = $name;
        }

        // $user->save();

        // return redirect()->route('mypages.mypage');
    }
    public function show()
    {
        // $users = User::all();
        // アンケートページのビューを返す処理
        return view('tops.question');
    }

    function update(Request $request)
    {
        $user = new User;
        // アンケートの内容をデータベースに保存
    
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
