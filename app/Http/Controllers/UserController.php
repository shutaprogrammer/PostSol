<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function show ($id)
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }
    
    function edit ($id)
    {
        // dd('ID:', $id);
        $user = Auth::user();
        // dd($user);
        return view('tops.create_profile', compact('user'));
    }

    function update(Request $request, $id)
    {
        $user = Auth::user();

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

        $user->save();

        return redirect()->route('mypages.mypage');
    }
}
