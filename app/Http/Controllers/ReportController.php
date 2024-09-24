<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function create($postId)
    {
        $post = Post::findOrFail($postId);

        return view('reports.create', compact('post'));
    }

    public function confirm(Request $request, $postId)
    {
        $postId = $request->input('post_id');
        $post = Post::findOrFail($postId);
        $reason = $request -> input('reason');
        $detail = $request->input('detail', ''); // デフォルト値を設定

        return view('reports.confirm', compact('post', 'reason', 'detail'));
    }

    public function store(Request $request, $postId)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'reason' => 'required|string', // DBカラム名に合わせる
            'detail' => 'nullable|string|max:1000', // DBカラム名に合わせる
        ]);

        // $post = Post::findOrFail($postId);
        $report = new Report();
        $report -> user_id = Auth::id();
        $report -> post_id = $validated['post_id'];
        $report -> reason = $validated['reason'];
        $report -> detail = $validated['detail'];
        $report -> save();
        
        return redirect()->route('reports.complete');
    }

    public function complete()
    {
        return view('reports.complete');
    }

}