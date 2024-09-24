<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function create()
    {
        return view('ads.create');  // 広告作成フォームのビューを返す
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'link' => 'required|url',
        ]);

        $imagePath = $request->file('image')->store('imgs', 'public');

        Ad::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'link' => $request->link,
        ]);

        return redirect()->route('ads.create')->with('success', '広告が正常に追加されました。');
    }
}